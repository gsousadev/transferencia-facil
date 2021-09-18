<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Entities;

class Shopkeeper implements ShopkeeperInterface
{
    protected $id;
    private $cnpj;
    private $trading_name;
    private $user_id;

    public function __construct(int $user_id ,string $cnpj, string $trading_name)
    {
        $this->cnpj = $cnpj;
        $this->trading_name = $trading_name;
        $this->user_id = $user_id;
    }

    public function getCNPJ(): string
    {
        return  $this->cnpj;
    }

    public function getTradingName(): string
    {
        return $this->trading_name;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
