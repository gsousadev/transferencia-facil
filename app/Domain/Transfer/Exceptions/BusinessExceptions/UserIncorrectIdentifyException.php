<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\BusinessExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

class UserIncorrectIdentifyException extends BaseExceptions
{
    protected $code = 422;
    public const SHORT_MESSAGE = 'UserIncorrectIdentify';
    public const DESCRIPTION_MESSAGE = 'Identificação de usuário incorreta. Vefifique o CPF ou CNPJ';

    public function __construct()
    {
        parent::__construct(
            self::SHORT_MESSAGE,
            self::DESCRIPTION_MESSAGE,
        );
    }
}
