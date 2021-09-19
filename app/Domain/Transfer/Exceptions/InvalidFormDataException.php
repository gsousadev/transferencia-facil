<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions;

class InvalidFormDataException extends BaseExceptions
{
    protected $code = 400;
    public const SHORT_MESSAGE = 'userNotFound';
    public const DESCRIPTION_MESSAGE = 'Usuário não encontrado';

    public function __construct(array $errors = [])
    {
        parent::__construct(
            self::SHORT_MESSAGE,
            self::DESCRIPTION_MESSAGE,
            $errors
        );
    }
}
