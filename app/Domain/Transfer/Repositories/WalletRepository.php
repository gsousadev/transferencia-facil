<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Domain\Transfer\Entities\Transaction;
use Domain\Transfer\Entities\Wallet;
use Domain\Transfer\Enumerators\WalletEnumerator;
use Infrastructure\Transfer\Models\EntityInterface;
use Infrastructure\Transfer\Repositories\EloquentORM\WalletORMRepository;
use Infrastructure\Transfer\Repositories\WalletRepositoryInterface;

class WalletRepository extends AbstractRepository
{
    /** @var WalletORMRepository */
    protected $externalRepository;

    public function __construct(WalletRepositoryInterface $repository)
    {
        $this->externalRepository = $repository;
    }

    /** @return Wallet */
    public function getEntity(): EntityInterface
    {
        return new Wallet();
    }

    public function getByFromUserId(int $id): ?Wallet
    {
        $attributes = $this->externalRepository->findOneBy('user_id', (string)$id);

        $entity = parent::filledEntity($attributes);

        if (!$entity instanceof Wallet) {
            return null;
        }

        $entity->setUserId($attributes['user_id']);
        $entity->setBalance($attributes['balance']);

        return $entity;
    }

    public function makeTransactionBetweenWallets(Transaction $transaction): void
    {
        $fromWallet = $this->updateBalanceByTransaction($transaction, WalletEnumerator::OPERATION_DEBIT);

        $this->persistUpdatedWalletBalance($fromWallet);

        $toWallet = $this->updateBalanceByTransaction($transaction, WalletEnumerator::OPERATION_CREDIT);

        $this->persistUpdatedWalletBalance($toWallet);
    }

    private function updateBalanceByTransaction(Transaction $transaction, string $operation): Wallet
    {
        if ($operation === WalletEnumerator::OPERATION_CREDIT) {
            $userId = (string)$transaction->getToId();
        }

        if ($operation === WalletEnumerator::OPERATION_DEBIT) {
            $userId = (string)$transaction->getFromId();
        }

        $walletAttribures = $this->externalRepository->findOneBy('user_id', $userId);

        $wallet = $this->getEntity();
        $wallet->setId($walletAttribures['id']);
        $wallet->setUserId($walletAttribures['user_id']);

        if ($operation === WalletEnumerator::OPERATION_CREDIT) {
            $wallet->setBalance((float)$walletAttribures['balance'] + $transaction->getValue());
        }

        if ($operation === WalletEnumerator::OPERATION_DEBIT) {
            $wallet->setBalance((float)$walletAttribures['balance'] - $transaction->getValue());
        }

        return $wallet;
    }

    private function persistUpdatedWalletBalance(Wallet $updatedWallet): Wallet
    {
        $result = $this->externalRepository->edit(
            $updatedWallet->getId(),
            ['balance' => $updatedWallet->getBalance()]
        );

        $updatedWallet->setBalance($result['balance']);

        return $updatedWallet;
    }
}
