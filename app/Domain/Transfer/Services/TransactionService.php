<?php

namespace Domain\Transfer\Services;

use Domain\Transfer\Entities\Shopkeeper;
use Domain\Transfer\Entities\Transaction;
use Domain\Transfer\Entities\User;
use Domain\Transfer\Entities\Wallet;
use Domain\Transfer\Exceptions\BusinessExceptions\InsufficientWalletBalanceException;
use Domain\Transfer\Exceptions\BusinessExceptions\SameUserReceivingAndPayingException;
use Domain\Transfer\Exceptions\BusinessExceptions\ShopkeppersCannotSendMoneyException;
use Domain\Transfer\Exceptions\BusinessExceptions\TransactionNotAuthorizedException;
use Domain\Transfer\Exceptions\BusinessExceptions\TransactionValueInvalidException;
use Domain\Transfer\Exceptions\BusinessExceptions\UserIncorrectIdentifyException;
use Domain\Transfer\Exceptions\BusinessExceptions\WalletNotFoundToUserException;
use Domain\Transfer\Exceptions\UserNotFoundException;
use Domain\Transfer\Repositories\ShopkeeperRepository;
use Domain\Transfer\Repositories\TransactionRepository;
use Domain\Transfer\Repositories\UserRepository;
use Domain\Transfer\Repositories\WalletRepository;

class TransactionService
{
    /** @var TransactionRepository */
    private $transactionRepository;

    /** @var UserRepository */
    private $userRepository;

    /** @var ShopkeeperRepository */
    private $shopkeeperRepository;

    /** @var WalletRepository */
    private $walletRepository;

    public function __construct(
        TransactionRepository $transactionRepository,
        UserRepository $userRepository,
        ShopkeeperRepository $shopkeeperRepository,
        WalletRepository $walletRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->shopkeeperRepository = $shopkeeperRepository;
        $this->walletRepository = $walletRepository;
    }

    public function process(array $data = []): array
    {
        $transaction = $this->store($data);

        return $this->confirmTransaction($transaction)->toArray();
    }

    private function store(array $data = [])
    {
        $fromUserIdentification = $data['from_user'] ?? '';
        $countFromUser = strlen($fromUserIdentification);

        if ($countFromUser != 11) {
            throw new ShopkeppersCannotSendMoneyException();
        }

        $fromUser = $this->getUserByCpfOrThrow($fromUserIdentification);

        $this->throwIfUserIsShopkeeper($fromUser);

        $toUserIdentification = $data['to_user'] ?? '';
        $countToUser = strlen($toUserIdentification);

        $value = $data['value'] ?? 0;

        if ($countToUser != 14 && $countToUser != 11) {
            throw new UserIncorrectIdentifyException();
        }

        if ($countToUser === 11) {
            $toUser = $this->getUserByCpfOrThrow($toUserIdentification);

            if (!$toUser instanceof User) {
                throw new UserNotFoundException('CPF', $toUserIdentification);
            }
        } else {
            $toUser = $this->shopkeeperRepository->getByCnpj($toUserIdentification);

            if (!$toUser instanceof Shopkeeper) {
                throw new UserNotFoundException('CNPJ', $toUserIdentification);
            }

            $toUser = $this->userRepository->getById($toUser->getUserId());

            if (!$toUser instanceof User) {
                throw new UserNotFoundException('CPF', $toUserIdentification);
            }
        }

        if ($fromUser->getCpf() === $toUser->getCpf()) {
            throw new SameUserReceivingAndPayingException();
        }

        if ($value <= 0 && !is_float($value)) {
            throw new TransactionValueInvalidException();
        }

        return $this->transactionRepository->store($fromUser, $toUser, $value);
    }

    public function find(array $filters = []): array
    {
        return $this->transactionRepository->find($filters);
    }

    private function getUserByCpfOrThrow(string $cpf): ?User
    {
        $user = $this->userRepository->getByCPF($cpf);

        if (!$user instanceof User) {
            throw new UserNotFoundException('CPF', $cpf);
        }

        return $user;
    }

    private function throwIfUserIsShopkeeper(User $fromUser): void
    {
        $shopkeeper = $this->shopkeeperRepository->getByFromUserId($fromUser->getId());

        if ($shopkeeper instanceof Shopkeeper) {
            throw new ShopkeppersCannotSendMoneyException();
        };
    }

    private function confirmTransaction(Transaction $transaction): Transaction
    {
        $this->verifyUserWallet($transaction);

        if(!$this->verifyExternalAuthorizeService($transaction)){
            throw new TransactionNotAuthorizedException();
        }

        $this->walletRepository->makeTransactionBetweenWallest($transaction);

        $this->sendNotification($transaction);

        return $transaction;
    }

    private function verifyUserWallet(Transaction $transaction)
    {
        $userWallet = $this->walletRepository->getByFromUserId($transaction->getFromId());

        if (!$userWallet instanceof Wallet) {
            throw new WalletNotFoundToUserException();
        }

        if ($userWallet->getBalance() < $transaction->getValue()) {
            $this->transactionRepository->cancelTransaction(
                $transaction,
                InsufficientWalletBalanceException::DESCRIPTION_MESSAGE
            );
            throw new InsufficientWalletBalanceException();
        }

        return $userWallet;
    }

    private function verifyExternalAuthorizeService(Transaction $transaction): bool
    {
        return $this->transactionRepository->verifyExternalAuthorizeService($transaction);
    }

    private function sendNotification(Transaction $transaction): bool
    {
        return $this->transactionRepository->verifyExternalAuthorizeService($transaction);
    }
}
