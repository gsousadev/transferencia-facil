<?php

declare(strict_types=1);

namespace App\Infrastructure\Transfer\Repositories\EloquentORM;

use App\Domain\Transfer\Entities\Entity;
use App\Domain\Transfer\Entities\ShopkeeperInterface;
use App\Domain\Transfer\Repositories\ShopkeeperRepositoryInterface;
use App\Infrastructure\Transfer\Models\Shopkeeper;

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
