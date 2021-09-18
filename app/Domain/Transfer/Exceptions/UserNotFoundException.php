<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions;

class UserNotFoundException extends BaseExceptions
{
    protected $code = 404;

    public function __construct(string $key = '', string $value = '')
    {
        $message = empty($key) ? 'Usuário não encontrado' : "Usuário de $key:$value não encontrado";

        parent::__construct(
            'userNotFound',
            $message
        );
    }
}
