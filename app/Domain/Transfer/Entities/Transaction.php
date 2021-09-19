<?php

declare(strict_types=1);

namespace Domain\Transfer\Entities;

use Domain\Transfer\Enumerators\TransactionEnumerator;
use Infrastructure\Transfer\Models\EntityAbstract;
use Infrastructure\Transfer\Models\TransactionInterface;

class Transaction extends EntityAbstract implements TransactionInterface
{
    /** @var float */
    private $value = null;
    /** @var int */
    private $fromId = null;
    /** @var int */
    private $toId = null;
    /** @var string */
    private $status = null;
    /** @var string */
    private $reasonCancellation = null;

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

    public function setReasonCancellation(string $reason): void
    {
        $this->reasonCancellation = $reason;
    }

    public function getReasonCancellation(): string
    {
        return $this->reasonCancellation;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'from_user_id' => $this->fromId,
            'to_user_id' => $this->toId,
            'value' => $this->value,
            'reason_cancellation' => $this->reasonCancellation,
            'status' => $this->status
        ];
    }
}

