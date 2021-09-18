<?php
namespace App\Domain\Exceptions\BusinessExceptions;

use App\Exceptions\BaseExceptions;

class SameUserReceivingAndPayingException extends BaseExceptions
{
    protected $code = 422;

    public function __construct()
    {
        parent::__construct(
            'SameUserReceivingAndPaying',
            'Transação Invalida. Pagador e Recebedor não podem ser iguais'
        );
    }
}
