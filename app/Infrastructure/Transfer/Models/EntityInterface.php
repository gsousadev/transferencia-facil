<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models;

interface EntityInterface
{
    public function getId(): int;

    public function getRequiredFields(): array;
}
