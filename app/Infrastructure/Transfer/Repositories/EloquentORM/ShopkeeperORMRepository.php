<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories\EloquentORM;

use Domain\Transfer\Entities\Entity;
use Domain\Transfer\Entities\ShopkeeperInterface;
use Domain\Transfer\Repositories\ShopkeeperRepositoryInterface;
use Infrastructure\Transfer\Models\Shopkeeper;

class ShopkeeperORMRepository extends AbstractORMRepository implements ShopkeeperRepositoryInterface
{
    public function getByCNPJ(string $cnpj): ?ShopkeeperInterface
    {
        $shopkeeper = Shopkeeper::query()->where('cnpj', $cnpj) ->first();

        return $shopkeeper instanceof ShopkeeperInterface ? $shopkeeper : null;
    }

    public function getByFromUserId(int $id): ?ShopkeeperInterface
    {
        $shopkeeper = Shopkeeper::query()->find($id);

        return $shopkeeper instanceof ShopkeeperInterface ? $shopkeeper : null;
    }

    public function getById(int $id): ?ShopkeeperInterface
    {
        $shopkeeper = Shopkeeper::query()->find($id);

        return $shopkeeper instanceof ShopkeeperInterface ? $shopkeeper : null;
    }
}
