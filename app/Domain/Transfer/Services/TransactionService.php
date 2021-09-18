<?php

namespace Domain\Transfer\Services;

use Domain\Transfer\Entities\ShopkeeperInterface;
use Domain\Transfer\Entities\Transaction;
use Domain\Transfer\Entities\UserInterface;
use Domain\Transfer\Exceptions\BusinessExceptions\SameUserReceivingAndPayingException;
use Domain\Transfer\Exceptions\BusinessExceptions\ShopkeppersCannotSendMoneyException;
use Domain\Transfer\Exceptions\BusinessExceptions\UserIncorrectIdentifyException;
use Domain\Transfer\Exceptions\UserNotFoundException;
use Domain\Transfer\Repositories\ShopkeeperRepositoryInterface;
use Domain\Transfer\Repositories\TransactionRepositoryInterface;
use Domain\Transfer\Repositories\UserRepositoryInterface;

class TransactionService
{
    /** @var TransactionRepositoryInterface */
    private $transactionRepository;
    /** @var UserRepositoryInterface */
    private $userRepository;
    /** @var ShopkeeperRepositoryInterface */
    private $shopkeeperRepository;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        UserRepositoryInterface $userRepository,
        ShopkeeperRepositoryInterface $shopkeeperRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->shopkeeperRepository = $shopkeeperRepository;
    }

    public function store(array $data = []): bool
    {
        $toUser = data_get($data, 'to_user');
        $fromUser = data_get($data, 'from_user');
        $value = data_get($data, 'value');

        $fromUser = $this->getUserByCpfOrThrow($fromUser);

        $this->throwIfUserIsShopkeeper($fromUser);

        $countToUser = strlen($toUser);

        if ($countToUser != 14 && $countToUser != 11) {
            throw new UserIncorrectIdentifyException();
        }

        if ($countToUser === 11) {
            $toUser = $this->getUserByCpfOrThrow($toUser);
        }

        if ($countToUser === 14) {
            $toUser = $this->shopkeeperRepository->getByCNPJ($toUser);

            if (!$toUser instanceof ShopkeeperInterface) {
                throw new UserNotFoundException('CNPJ', $fromUser);
            }

            $toUser = $this->userRepository->getById($toUser->getUserId());
        }

        if ($fromUser->getCpf() === $toUser->getCpf()) {
            throw new SameUserReceivingAndPayingException();
        }

        $transaction = new Transaction($fromUser->getId(), $toUser->getId(), $value);

        return $this->transactionRepository->store($transaction);
    }

    public function find(array $filters = []): array
    {
        return $this->transactionRepository->find($filters);
    }

    private function getUserByCpfOrThrow(string $cpf): ?UserInterface
    {
        $user = $this->userRepository->getByCPF($cpf);

        if (!$user instanceof UserInterface) {
            throw new UserNotFoundException('CPF', $cpf);
        }

        return $user;
    }

    private function throwIfUserIsShopkeeper(UserInterface $fromUser): void
    {
        $shopkeeper = $this->shopkeeperRepository->getByFromUserId($fromUser->getId());

        if ($shopkeeper instanceof ShopkeeperInterface) {
            throw new ShopkeppersCannotSendMoneyException();
        };
    }
}
