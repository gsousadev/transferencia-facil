<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Entities;

class Wallet extends Entity implements WalletInterface
{
    public function getBalance(): float
    {
        // TODO: Implement getBalance() method.
    }
}
