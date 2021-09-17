<?php
namespace App\Domain\Exceptions\BusinessExceptions;

use App\Exceptions\BaseExceptions;

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
