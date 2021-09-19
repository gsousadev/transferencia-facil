<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories\EloquentORM;

use Infrastructure\Transfer\Models\EloquentORM\User;
use Infrastructure\Transfer\Models\UserInterface;
use Infrastructure\Transfer\Repositories\UserRepositoryInterface;

class UserORMRepository extends AbstractORMRepository  implements UserRepositoryInterface
{
    public function __construct()
    {
        $this->model = new User();
    }

    public function getByCPF(string $cpf): ?UserInterface
    {
        // TODO: Implement getByCPF() method.
    }
}
