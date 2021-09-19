<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models;

interface ShopkeeperInterface
{
    public function getCnpj(): string;
    public function setCnpj(string $value): void;
    public function getTradingName(): string;
    public function setTradingName(string $value): void;
    public function getUserId(): int;
    public function setUserId(int $value): void;
}
