<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\BusinessExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

class TransactionNotAuthorizedException extends BaseExceptions
{
    protected $code = 422;
    public const SHORT_MESSAGE = 'TransactionNotAuthorized';
    public const DESCRIPTION_MESSAGE = 'Transação Não Autorizada';

    public function __construct()
    {
        parent::__construct(
            self::SHORT_MESSAGE,
            self::DESCRIPTION_MESSAGE,
        );
    }
}
