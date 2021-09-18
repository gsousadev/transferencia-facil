<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

interface AbstractRepositoryInterface
{
    public function getById(int $id);
}
