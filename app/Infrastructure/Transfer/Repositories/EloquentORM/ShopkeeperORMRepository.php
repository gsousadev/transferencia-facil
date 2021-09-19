<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories\EloquentORM;

use Infrastructure\Transfer\Models\EloquentORM\Shopkeeper;
use Infrastructure\Transfer\Repositories\ShopkeeperRepositoryInterface;

class ShopkeeperORMRepository extends AbstractORMRepository implements ShopkeeperRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Shopkeeper();
    }
}
