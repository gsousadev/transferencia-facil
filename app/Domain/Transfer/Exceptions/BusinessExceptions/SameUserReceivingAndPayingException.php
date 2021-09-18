<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\BusinessExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

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
