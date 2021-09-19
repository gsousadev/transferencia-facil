<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories\EloquentORM;

use Illuminate\Database\Eloquent\Model;

interface AbstractORMRepositoryInterface
{
    public function getById(int $id): ?array;

    public function findOneBy(string $key, string $value): ?array;

    public function findBy(string $key, string $value): ?array;

    public function store(array $attributes = []): array;

    public function edit(int $id, array $attributes = []): array;
}
