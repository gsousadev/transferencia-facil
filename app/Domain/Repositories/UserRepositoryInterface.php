<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\User;

interface UserRepositoryInterface
{
    public function findByCPF(string $identifier): User;

    public function findByCNPJ(string $identifier): User;
}
