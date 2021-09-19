<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories\EloquentORM;

interface AbstractORMRepositoryInterface
{
    public function getById(int $id): ?array;

    public function findOneBy(string $key, string $value): ?array;

    public function findBy(string $key, string $value): ?array;

    public function store(array $attributes = []): bool;

    public function edit(int $id, array $attributes = []): bool;
}
