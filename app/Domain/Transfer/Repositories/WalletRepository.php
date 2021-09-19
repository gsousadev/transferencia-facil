<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Domain\Transfer\Entities\Transaction;
use Domain\Transfer\Entities\Wallet;
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

    public function getByFromUserId(int $id): ? Wallet
    {
        $attributes = $this->externalRepository->findOneBy('user_id', (string) $id);

        $entity = parent::filledEntity($attributes);

        if (!$entity instanceof Wallet) {
            return null;
        }

        $entity->setUserId($attributes['user_id']);
        $entity->setBalance($attributes['balance']);

        return $entity;
    }

    public function makeTransactionBetweenWallest(Transaction $transaction): void
    {
        $fromWalletAttribures = $this->externalRepository->findOneBy('user_id', (string) $transaction->getFromId());

        $fromWallet = $this->getEntity();

        $fromWallet->setId($fromWalletAttribures['id']);
        $fromWallet->setUserId($fromWalletAttribures['user_id']);

        $fromWallet->setBalance((float) $fromWalletAttribures['balance'] - $transaction->getValue());

        $result = $this->externalRepository->edit(
            $fromWallet->getId(),
            ['balance' => $fromWallet->getBalance()]
        );

        $fromWallet->setBalance($result['balance']);

        $toWalletAttribures = $this->externalRepository->findOneBy('user_id', (string) $transaction->getToId());

        $toWallet = $this->getEntity();

        $toWallet->setId($toWalletAttribures['id']);
        $toWallet->setUserId($toWalletAttribures['user_id']);

        $toWallet->setBalance((float) $toWalletAttribures['balance'] - $transaction->getValue());

        $result = $this->externalRepository->edit(
            $toWallet->getId(),
            ['balance' => $toWallet->getBalance()]
        );

        $toWallet->setBalance($result['balance']);
    }
}
