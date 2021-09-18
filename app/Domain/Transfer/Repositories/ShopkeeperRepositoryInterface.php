<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Domain\Transfer\Entities\ShopkeeperInterface;

interface ShopkeeperRepositoryInterface
{
    public function getByFromUserId(int $id): ?ShopkeeperInterface;
}
