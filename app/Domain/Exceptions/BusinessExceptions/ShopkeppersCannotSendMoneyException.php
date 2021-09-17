<?php
namespace App\Domain\Exceptions\BusinessExceptions;

use App\Exceptions\BaseExceptions;

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
