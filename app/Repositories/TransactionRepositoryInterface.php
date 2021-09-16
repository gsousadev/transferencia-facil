<?php

namespace App\Repositories;

use App\Models\User;

interface TransactionRepositoryInterface
{
    public function store(User $fromUser, User $toUser, float $value = 0): bool;
}
