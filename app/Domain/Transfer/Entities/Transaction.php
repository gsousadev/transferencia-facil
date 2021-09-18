<?php

declare(strict_types=1);

namespace Domain\Transfer\Entities;

use Domain\Transfer\Exceptions\BusinessExceptions\SameUserReceivingAndPayingException;

class Transaction implements TransactionInterface
{
    protected $id;
    private $value;
    private $from_id;
    private $to_id;
    private $status;

    public function __construct(int $from_id, int $to_id, float $value, string $status)
    {
        $this->from_id = $from_id;
        $this->to_id = $to_id;
        $this->value = $value;
        $this->status = $status;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getFromId(): int
    {
        return $this->from_id;
    }

    public function getToId(): int
    {
        return $this->to_id;
    }

    public function throwIfFromUserAndToUserIsSame(): void
    {
        if ($this->from->getCpf() === $this->to->getCpf()) {
            throw new SameUserReceivingAndPayingException();
        }
    }

    public function getId(): int
    {
        return $this->id;
    }
}

