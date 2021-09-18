<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories\EloquentORM;

use Domain\Transfer\Entities\UserInterface;

use Domain\Transfer\Repositories\UserRepositoryInterface;
use Infrastructure\Transfer\Models\User;

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
