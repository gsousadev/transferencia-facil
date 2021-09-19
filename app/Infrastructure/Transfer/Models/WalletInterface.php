<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models;

interface WalletInterface
{
    public function getBalance(): float;
    public function setBalance(float $value): void;
    public function getUserId(): int;
    public function setUserId(int $value): void;
}
