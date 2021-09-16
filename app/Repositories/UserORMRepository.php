<?php

namespace App\Repositories;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserORMRepository implements UserRepositoryInterface
{
    public function findByCPF(string $identifier): User
    {
        $user = User::query()->where('cpf', $identifier)->first();

        if (!$user instanceof User) {
            throw new UserNotFoundException;
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
