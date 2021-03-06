<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\BusinessExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

class TransactionValueInvalidException extends BaseExceptions
{
    protected $code = 422;
    public const SHORT_MESSAGE = 'TransactionValueInvalid';
    public const DESCRIPTION_MESSAGE = 'Valor de transferĂȘncia invalido';

    public function __construct()
    {
        parent::__construct(
            self::SHORT_MESSAGE,
            self::DESCRIPTION_MESSAGE
        );
    }
}
