<?php

declare(strict_types=1);

namespace Domain\Transfer\Entities;

interface WalletInterface
{
    public function getBalance(): float;
}
