<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use App\Exceptions\BaseExceptions;

class UserNotFoundException extends BaseExceptions
{
    protected $code = 404;

    public function __construct()
    {
        parent::__construct(
            'userNotFound',
            'Usuário não encontrado'
        );
    }
}
