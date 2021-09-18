<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Repositories;

use App\Domain\Transfer\Entities\UserInterface;

interface UserRepositoryInterface
{
    public function getByCPF(string $cpf): ?UserInterface;
}
