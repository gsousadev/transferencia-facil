<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models;

interface TransactionInterface
{
    public function getValue(): float;
    public function setValue(float $value): void;
    public function getStatus(): string;
    public function setStatus(string $value): void;
    public function getFromId(): int;
    public function setFromId(int $value): void;
    public function getToId(): int;
    public function setToId(int $value): void;
}
