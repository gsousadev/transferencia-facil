<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface
{
    public function store(User $fromUser, User $toUser, float $value = 0): bool;

    public function find(array $filters = []): Collection;
}
