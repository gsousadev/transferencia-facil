<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Entities;

interface TransactionInterface
{
    public function getValue(): float;

    public function getStatus(): string;

    public function getFromUser(): UserInterface;

    public function getToUser(): UserInterface;
}
