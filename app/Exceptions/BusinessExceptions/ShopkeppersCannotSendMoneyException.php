<?php
namespace App\Exceptions\BusinessExceptions;

use App\Exceptions\BaseExceptions;

class ShopkeppersCannotSendMoneyException extends BaseExceptions
{
    public function __construct()
    {
        parent::__construct(
            'ShopkeppersCannotSendMoney',
            'Logista não pode enviar dinheiro, apenas receber'
        );
    }
}
