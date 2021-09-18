<?php

declare(strict_types=1);

namespace Domain\Transfer\Entities;

interface ShopkeeperInterface
{
    public function getCNPJ(): string;

    public function getTradingName(): string;

    public function getUserId(): int;
}
