<?php

namespace App\Domain\Services;

use App\Domain\Exceptions\BusinessExceptions\ShopkeppersCannotSendMoneyException;
use App\Domain\Exceptions\BusinessExceptions\UserIncorrectIdentifyException;
use App\Domain\Models\Shopkeeper;
use App\Domain\Repositories\TransactionRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TransactionService
{
    private $transactionRepository;
    private $userRepository;

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

        if ($fromUser->shopkeeper instanceof Shopkeeper) {
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

    public function find(array $filters = []): Collection
    {
        return $this->transactionRepository->find($filters);
    }
}
