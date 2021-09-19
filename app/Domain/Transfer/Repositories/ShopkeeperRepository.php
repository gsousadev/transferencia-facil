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
        // TODO: Implement getByCNPJ() method.
    }

    public function filledEntity(array $attributes = []): ?Shopkeeper
    {
        $entity = parent::filledEntity();

        if (!$entity instanceof Shopkeeper){
            return $entity;
        }

        $entity->setCnpj($attributes['id']);
        $entity->setTradingName($attributes['trading_name']);

        return $entity;
    }
}
