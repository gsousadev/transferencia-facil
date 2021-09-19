<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Infrastructure\Transfer\Repositories\AbstractRepositoryInterface;

abstract class AbstractRepository implements AbstractRepositoryInterface
{
    protected $externalRepository;

    public function filledEntity(array $attributes = [])
    {
        if (empty($attributes)) {
            return null;
        }

        $entity = $this->getEntity();

        $entity->setId($attributes['id']);

        return $entity;
    }
}
