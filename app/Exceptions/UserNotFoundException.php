<?php

namespace App\Exceptions;

class UserNotFoundException extends BaseExceptions
{
    public function __construct()
    {
        parent::__construct(
            'userNotFound',
            'Usuário não encontrado'
        );
    }
}
