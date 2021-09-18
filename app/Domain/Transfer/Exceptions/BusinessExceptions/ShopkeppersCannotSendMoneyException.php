<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Exceptions\BusinessExceptions;

use App\Domain\Transfer\Exceptions\BaseExceptions;

class ShopkeppersCannotSendMoneyException extends BaseExceptions
{
    protected $code = 422;

    public function __construct()
    {
        parent::__construct(
            'ShopkeppersCannotSendMoney',
            'Logista não pode enviar dinheiro, apenas receber'
        );
    }
}
