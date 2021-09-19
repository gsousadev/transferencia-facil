<?php

declare(strict_types=1);

namespace Domain\Transfer\Entities;

use Infrastructure\Transfer\Models\EntityAbstract;
use Infrastructure\Transfer\Models\TransactionInterface;

class Transaction extends EntityAbstract implements TransactionInterface
{
    /** @var float  */
    private $value;
    /** @var int  */
    private $fromId;
    /** @var int  */
    private $toId;
    /** @var string  */
    private $status;

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getFromId(): int
    {
        return $this->fromId;
    }

    public function setFromId(int $fromId): void
    {
        $this->fromId = $fromId;
    }

    public function getToId(): int
    {
        return $this->toId;
    }

    public function setToId(int $toId): void
    {
        $this->toId = $toId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}

