<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Entities;

interface WalletInterface
{
    public function getBalance(): float;
}
