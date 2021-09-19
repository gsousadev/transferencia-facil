<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories;

interface AbstractRepositoryInterface
{
    public function getEntity();

    public function filledEntity();
}
