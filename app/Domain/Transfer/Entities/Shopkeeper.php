<?php

declare(strict_types=1);

namespace Domain\Transfer\Entities;

use Infrastructure\Transfer\Models\EntityAbstract;
use Infrastructure\Transfer\Models\ShopkeeperInterface;

class Shopkeeper extends EntityAbstract implements ShopkeeperInterface
{
    /** @var string */
    private $cnpj;
    /** @var string */
    private $tradingName;
    /** @var int */
    private $userId;

    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): void
    {
        $this->cnpj = $cnpj;
    }

    public function getTradingName(): string
    {
        return $this->tradingName;
    }

    public function setTradingName(string $tradingName): void
    {
        $this->tradingName = $tradingName;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
}
