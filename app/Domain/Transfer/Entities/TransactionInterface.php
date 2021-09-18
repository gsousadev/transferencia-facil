<?php

declare(strict_types=1);

namespace Domain\Transfer\Entities;

interface TransactionInterface
{
    public function getId(): int;

    public function getValue(): float;

    public function getStatus(): string;

    public function getFromId(): int;

    public function getToId(): int;
}
