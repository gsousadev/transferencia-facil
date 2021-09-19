<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions;

class UserNotFoundException extends BaseExceptions
{
    protected $code = 404;
    public const SHORT_MESSAGE = 'userNotFound';
    public const DESCRIPTION_MESSAGE = 'Usuário não encontrado';

    public function __construct(string $key = '', string $value = '')
    {
        $message = empty($key) ? self::DESCRIPTION_MESSAGE : "Usuário de $key:$value não encontrado";

        parent::__construct(
            self::SHORT_MESSAGE,
            $message
        );
    }
}
