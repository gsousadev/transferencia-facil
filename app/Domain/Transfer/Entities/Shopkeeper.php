<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Entities;

class Shopkeeper extends Entity implements ShopkeeperInterface
{
    private $cnpj;
    private $trandingName;
    private $id;

    public function getCNPJ(): string
    {
        return  $this->cnpj;
    }

    public function getTradingName(): string
    {
        return $this->trandingName;
    }

    public function getUserId(): int
    {
        return $this->id;
    }
}
