<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Domain\Transfer\Entities\Transaction;
use Domain\Transfer\Entities\User;
use Domain\Transfer\Enumerators\TransactionEnumerator;
use Domain\Transfer\Exceptions\IntegrationExceptions\ExternalAuthorizationServiceException;
use Domain\Transfer\Exceptions\IntegrationExceptions\SendNotificationServiceException;
use Infrastructure\Transfer\Models\EntityInterface;
use Infrastructure\Transfer\Repositories\ExternalAuthorizeServiceInterface;
use Infrastructure\Transfer\Repositories\SendNotificationServiceInterface;
use Infrastructure\Transfer\Repositories\TransactionRepositoryInterface;

class TransactionRepository extends AbstractRepository
{

    protected $externalRepository;
    private $externalAuthorizeService;
    private $sendNotificationService;

    public function __construct(
        TransactionRepositoryInterface $repository,
        ExternalAuthorizeServiceInterface $externalAuthorizeService,
        SendNotificationServiceInterface $sendNotificationService
    ) {
        $this->externalRepository = $repository;
        $this->externalAuthorizeService = $externalAuthorizeService;
        $this->sendNotificationService = $sendNotificationService;
    }

    /** @return Transaction */
    public function getEntity(): EntityInterface
    {
        return new Transaction();
    }

    public function store(User $fromUser, User $toUser, float $value): Transaction
    {
        $transaction = $this->getEntity();
        $transaction->setFromId($fromUser->getId());
        $transaction->setToId($toUser->getId());
        $transaction->setValue($value);
        $transaction->setStatus(TransactionEnumerator::STATUS_PROCESSING);

        $return = $this->externalRepository->store($transaction->toArray());

        $transaction->setId($return['id']);

        return $transaction;
    }

    public function find(array $filters = []): ?array
    {
        return $this->externalRepository->find($filters);
    }

    public function cancelTransaction(Transaction $transaction, string $reason): Transaction
    {
        $result = $this->externalRepository->edit(
            $transaction->getId(),
            [
                'status' => TransactionEnumerator::STATUS_CANCELED,
                'reason_cancellation' => $reason
            ]
        );

        $transaction->setStatus($result['status']);
        $transaction->setReasonCancellation($result['reason_cancellation']);

        return $transaction;
    }

    public function verifyExternalAuthorizeService(Transaction $transaction): bool
    {
        try {
            return $this->externalAuthorizeService->verify($transaction->toArray());
        } catch (\Throwable $throwable) {
            throw new ExternalAuthorizationServiceException($throwable->getCode(), $throwable->getMessage());
        }
    }

    public function sendNotification(Transaction $transaction): bool
    {
        return $this->sendNotificationService->send($transaction->toArray());
    }

    public function changeStatusToSuccess(Transaction $transaction): Transaction
    {
        $result = $this->externalRepository->edit(
            $transaction->getId(),
            [
                'status' => TransactionEnumerator::STATUS_APPROVED,
            ]
        );

        $transaction->setStatus($result['status']);

        return $transaction;
    }
}
