<?php

namespace App\Services;

use App\Exceptions\BusinessExceptions\ShopkeppersCannotSendMoneyException;
use App\Exceptions\BusinessExceptions\UserIncorrectIdentifyException;
use App\Models\Shopkeepers;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class TransactionService
{
    private TransactionRepositoryInterface $transactionRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
    }

    public function store(array $data = []): bool
    {
        $fromUser = $this->userRepository->findByCPF(data_get($data, 'from_user'));

        if ($fromUser->shopkeeper instanceof Shopkeepers) {
            throw new ShopkeppersCannotSendMoneyException();
        };

        $toUser = data_get($data, 'to_user');

        $countToUser = strlen($toUser);

        if ($countToUser != 14 && $countToUser != 11) {
            throw new UserIncorrectIdentifyException();
        }

        if ($countToUser === 14) {
            $toUser = $this->userRepository->findByCPF($toUser);
        }

        if ($countToUser === 11) {
            $toUser = $this->userRepository->findByCNPJ($toUser);
        }

        return $this->transactionRepository->store($fromUser, $toUser, data_get($data, 'value'));
    }
}
