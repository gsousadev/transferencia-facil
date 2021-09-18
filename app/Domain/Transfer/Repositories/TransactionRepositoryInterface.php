<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Repositories;

use App\Domain\Transfer\Entities\TransactionInterface;

interface TransactionRepositoryInterface
{
    public function store(TransactionInterface $transaction): bool;

    public function find(array $filters = []): array;
}
