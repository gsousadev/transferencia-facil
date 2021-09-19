<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models;

abstract class EntityAbstract implements EntityInterface
{
    protected $id;

    protected $requiredFields = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getRequiredFields(): array
    {
        return $this->requiredFields;
    }
}
