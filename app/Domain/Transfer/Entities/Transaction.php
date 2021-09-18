<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Entities;

use App\Domain\Transfer\Exceptions\BusinessExceptions\SameUserReceivingAndPayingException;

class Transaction extends Entity implements TransactionInterface
{
    private $value;
    private $from;
    private $to;
    private $status;

    public function __construct(UserInterface $from, UserInterface $to, float $value = 0)
    {
        $this->from = $from;
        $this->to = $to;
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getFromUser(): UserInterface
    {
        return $this->from;
    }

    public function getToUser(): UserInterface
    {
        return $this->to;
    }

    public function throwIfFromUserAndToUserIsSame(): void
    {
        if ($this->from->getCpf() === $this->to->getCpf()) {
            throw new SameUserReceivingAndPayingException();
        }
    }

    public function throwIfFromUserIsShopkeeper():void{

    }
}

