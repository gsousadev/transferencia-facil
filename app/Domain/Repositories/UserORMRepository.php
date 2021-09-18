<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Exceptions\UserNotFoundException;
use App\Domain\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserORMRepository implements UserRepositoryInterface
{
    public function findByCPF(string $identifier): User
    {
        $user = User::query()->where('cpf', $identifier)->first();

        if (!$user instanceof User) {
            throw new UserNotFoundException('cpf', $identifier);
        }

        return $user;
    }

    public function findByCNPJ(string $identifier): User
    {
        $user = User::query()
            ->whereHas('shopkeeper', function (Builder $query) use ($identifier): Builder {
                return $query->where('cnpj', $identifier);
            })
            ->first();

        if (!$user instanceof User) {
            throw new UserNotFoundException;
        }

        return $user;
    }
}
