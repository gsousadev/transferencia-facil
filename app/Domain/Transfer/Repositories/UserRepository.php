<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Domain\Transfer\Entities\User;
use Infrastructure\Transfer\Models\UserInterface;
use Infrastructure\Transfer\Repositories\EloquentORM\UserORMRepository;
use Infrastructure\Transfer\Repositories\UserRepositoryInterface;

class UserRepository extends AbstractRepository
{
    /** @var UserORMRepository */
    protected $externalRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->externalRepository = $userRepository;
    }
    /** @return User */
    public function getEntity(): User
    {
        return new User();
    }

    public function getByCPF(string $cpf): ?UserInterface
    {
        $attributes = $this->externalRepository->findOneBy('cpf', $cpf);

        return $this->filledEntity($attributes);
    }

    public function filledEntity(array $attributes = []): ?User
    {
        $entity = parent::filledEntity($attributes);

        if (!$entity instanceof User) {
            return null;
        }

        $entity->setCpf($attributes['cpf']);
        $entity->setEmail($attributes['email']);
        $entity->setName($attributes['name']);
        $entity->setPassword($attributes['password']);

        return $entity;
    }

    public function find(array $filters = []): ?array
    {
        $relations = ['wallet'];

        return $this->externalRepository->find($filters, $relations);
    }
}
