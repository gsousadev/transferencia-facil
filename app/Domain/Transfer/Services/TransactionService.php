<?php

namespace Domain\Transfer\Services;

use Domain\Transfer\Entities\Shopkeeper;
use Domain\Transfer\Entities\Transaction;
use Domain\Transfer\Entities\User;
use Domain\Transfer\Exceptions\BusinessExceptions\SameUserReceivingAndPayingException;
use Domain\Transfer\Exceptions\BusinessExceptions\ShopkeppersCannotSendMoneyException;
use Domain\Transfer\Exceptions\BusinessExceptions\UserIncorrectIdentifyException;
use Domain\Transfer\Exceptions\UserNotFoundException;
use Domain\Transfer\Repositories\ShopkeeperRepository;
use Domain\Transfer\Repositories\TransactionRepository;
use Domain\Transfer\Repositories\UserRepository;

class TransactionService
{
    /** @var TransactionRepository */
    private $transactionRepository;
    /** @var UserRepository*/
    private $userRepository;
    /** @var ShopkeeperRepository */
    private $shopkeeperRepository;

    public function __construct(
        TransactionRepository $transactionRepository,
        UserRepository $userRepository,
        ShopkeeperRepository $shopkeeperRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->shopkeeperRepository = $shopkeeperRepository;
    }

    public function store(array $data = []): bool
    {
        $fromUserIdentification = data_get($data, 'from_user');
        $countFromUser = strlen($fromUserIdentification);

        if ($countFromUser != 11) {
            throw new ShopkeppersCannotSendMoneyException();
        }

        $fromUser = $this->getUserByCpfOrThrow($fromUserIdentification);

        $this->throwIfUserIsShopkeeper($fromUser);

        dd('teste');

        $toUserIdentification = data_get($data, 'to_user');
        $countToUser = strlen($toUserIdentification);

        $value = data_get($data, 'value');

        if ($countToUser != 14 && $countToUser != 11) {
            throw new UserIncorrectIdentifyException();
        }

        if ($countToUser === 11) {
            $toUser = $this->getUserByCpfOrThrow($toUser);
        }

        if ($countToUser === 14) {
            $toUser = $this->shopkeeperRepository->getByCNPJ($toUser);

            if (!$toUser instanceof Shopkeeper) {
                throw new UserNotFoundException('CNPJ', $toUser->getCnpj());
            }

            $toUser = $this->userRepository->getById($toUser->getUserId());
        }

        if ($fromUser->getCpf() === $toUser->getCpf()) {
            throw new SameUserReceivingAndPayingException();
        }

        $transaction = new Transaction();

        return $this->transactionRepository->store($transaction);
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
}
