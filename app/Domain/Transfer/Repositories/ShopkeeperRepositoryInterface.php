<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Repositories;

use App\Domain\Transfer\Entities\ShopkeeperInterface;

interface ShopkeeperRepositoryInterface
{
    public function getByFromUserId(int $id): ?ShopkeeperInterface;
}
