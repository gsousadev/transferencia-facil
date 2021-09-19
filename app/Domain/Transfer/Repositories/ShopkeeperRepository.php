<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Domain\Transfer\Entities\Shopkeeper;
use Infrastructure\Transfer\Models\EntityInterface;
use Infrastructure\Transfer\Models\ShopkeeperInterface;
use Infrastructure\Transfer\Repositories\EloquentORM\ShopkeeperORMRepository;
use Infrastructure\Transfer\Repositories\ShopkeeperRepositoryInterface;

class ShopkeeperRepository extends AbstractRepository
{
    /** @var ShopkeeperORMRepository */
    protected $externalRepository;

    public function __construct(ShopkeeperRepositoryInterface $repository)
    {
        $this->externalRepository = $repository;
    }
    /** @return Shopkeeper */
    public function getEntity(): EntityInterface
    {
        return new Shopkeeper();
    }

    public function getByFromUserId(int $id): ?ShopkeeperInterface
    {
        $attributes = $this->externalRepository->findBy('user_id', (string) $id);

        return $this->filledEntity($attributes);
    }

    public function getByCnpj(string $cnpj): ?ShopkeeperInterface
    {
        $attributes = $this->externalRepository->findOneBy('cnpj', $cnpj);

        return $this->filledEntity($attributes);
    }

    public function filledEntity(array $attributes = []): ?Shopkeeper
    {
        $entity = parent::filledEntity($attributes);

        if (!$entity instanceof Shopkeeper){
            return null;
        }

        $entity->setUserId($attributes['user_id']);
        $entity->setCnpj($attributes['cnpj']);
        $entity->setTradingName($attributes['trading_name']);

        return $entity;
    }
}
