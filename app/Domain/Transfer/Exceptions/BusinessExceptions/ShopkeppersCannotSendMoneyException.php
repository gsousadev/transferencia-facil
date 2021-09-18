<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\BusinessExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

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
