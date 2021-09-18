<?php

declare(strict_types=1);

namespace App\Infrastructure\Transfer\Repositories\EloquentORM;

use App\Domain\Transfer\Entities\UserInterface;

use App\Domain\Transfer\Repositories\UserRepositoryInterface;
use App\Infrastructure\Transfer\Models\User;

class UserORMRepository extends AbstractORMRepository implements UserRepositoryInterface
{
    public function getByCPF(string $cpf): ?UserInterface
    {
        $user = User::query()->where('cpf', $cpf)->first();

        return $user instanceof UserInterface ? $user : null;
    }

    public function getById(int $id): ?UserInterface
    {
        $user = User::query()->find($id);

        return $user instanceof UserInterface ? $user : null;
    }
}
