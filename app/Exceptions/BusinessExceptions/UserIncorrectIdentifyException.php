<?php
namespace App\Exceptions\BusinessExceptions;

use App\Exceptions\BaseExceptions;

class UserIncorrectIdentifyException extends BaseExceptions
{
    public function __construct()
    {
        parent::__construct(
            'UserIncorrectIdentify',
            'Identificação de usuário incorreta. Vefifique o CPF ou CNPJ'
        );
    }
}
