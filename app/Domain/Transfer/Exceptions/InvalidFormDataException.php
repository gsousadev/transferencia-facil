<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Exceptions;

class InvalidFormDataException extends BaseExceptions
{
    protected $code = 400;

    public function __construct(array $errors = [])
    {
        parent::__construct(
            'invalidData',
            'Dados incorretos. Verifique os erros encontrados',
            $errors
        );
    }
}
