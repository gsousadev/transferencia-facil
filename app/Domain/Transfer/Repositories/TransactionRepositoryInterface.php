<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Domain\Transfer\Entities\TransactionInterface;

interface TransactionRepositoryInterface
{
    public function store(TransactionInterface $transaction): bool;

    public function find(array $filters = []): array;
}
