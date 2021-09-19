<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\BusinessExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

class WalletNotFoundToUserException extends BaseExceptions
{
    protected $code = 404;
    public const SHORT_MESSAGE = 'WalletNotFoundToUser';
    public const DESCRIPTION_MESSAGE = 'Não foi encontrada nenhuma conta para o usuário';

    public function __construct()
    {
        parent::__construct(
            self::SHORT_MESSAGE,
            self::DESCRIPTION_MESSAGE,
        );
    }
}
