<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories;

interface TransactionRepositoryInterface
{
    public function find(array $filters = []): ?array;
}
