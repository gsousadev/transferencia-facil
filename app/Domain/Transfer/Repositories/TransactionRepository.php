<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Domain\Transfer\Entities\Transaction;
use Domain\Transfer\Entities\User;
use Infrastructure\Transfer\Models\EntityInterface;
use Infrastructure\Transfer\Repositories\EloquentORM\TransactionORMRepository;
use Infrastructure\Transfer\Repositories\TransactionRepositoryInterface;

class TransactionRepository extends AbstractRepository
{
    /** @var TransactionORMRepository */
    protected $externalRepository;

    public function __construct(TransactionRepositoryInterface $repository)
    {
        $this->externalRepository = $repository;
    }

    /** @return Transaction */
    public function getEntity(): EntityInterface
    {
        return new Transaction();
    }

    public function store(User $fromUser, User $toUser, float $value): array
    {
        $transaction = $this->getEntity();

        $transaction->setFromId($fromUser->getId());
        $transaction->setToId($toUser->getId());
        $transaction->setValue($value);

        return $this->externalRepository->store($transaction->toSave());
    }
}
