<?php

declare(strict_types=1);

namespace Domain\Transfer\Entities;

use Infrastructure\Transfer\Models\EntityAbstract;
use Infrastructure\Transfer\Models\WalletInterface;

class Wallet extends EntityAbstract implements WalletInterface
{
    private $balance;
    private $userId;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function setBalance(float $value): void
    {
        $this->balance = $value;
    }

    public function setUserId(int $value): void
    {
       $this->userId = $value;
    }
}
