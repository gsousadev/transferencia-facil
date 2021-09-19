<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories;

interface AbstractRepositoryInterface
{
    public function getById(int $id);

    public function getEntity();

    public function find();

    public function filledEntity();
}
