<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\BusinessExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

class SameUserReceivingAndPayingException extends BaseExceptions
{
    protected $code = 422;
    public const SHORT_MESSAGE = 'SameUserReceivingAndPaying';
    public const DESCRIPTION_MESSAGE = 'Transação Invalida. Pagador e Recebedor não podem ser iguais';

    public function __construct()
    {
        parent::__construct(
            self::SHORT_MESSAGE,
            self::DESCRIPTION_MESSAGE,
        );
    }
}
