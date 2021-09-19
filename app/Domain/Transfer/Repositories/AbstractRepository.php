<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Infrastructure\Transfer\Repositories\AbstractRepositoryInterface;

abstract class AbstractRepository implements AbstractRepositoryInterface
{
    protected $externalRepository;

    public function getById(int $id)
    {
        $attributes = $this->externalRepository->getById($id);

        return $this->filledEntity($attributes);
    }

    public function filledEntity(array $attributes = [])
    {
        if (empty($attributes)) {
            return $attributes;
        }

        $entity = $this->getEntity();

        $entity->setId($attributes['id']);

        return $entity;
    }

    public function find(array $filters = []): ?array
    {
        return $this->externalRepository->find($filters);
    }
}
