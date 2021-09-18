<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Domain\Transfer\Entities\UserInterface;

interface UserRepositoryInterface
{
    public function getByCPF(string $cpf): ?UserInterface;
}
