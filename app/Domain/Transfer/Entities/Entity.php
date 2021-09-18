<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Entities;

abstract class Entity implements EntityInterface
{
    private $id;

    public function getId():int
    {
        return  $this->id;
    }
}
