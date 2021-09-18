<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\BusinessExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

class UserIncorrectIdentifyException extends BaseExceptions
{
    protected $code = 422;

    public function __construct()
    {
        parent::__construct(
            'UserIncorrectIdentify',
            'Identificação de usuário incorreta. Vefifique o CPF ou CNPJ'
        );
    }
}
