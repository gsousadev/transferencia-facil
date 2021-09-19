<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\BusinessExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

class InsufficientWalletBalanceException extends BaseExceptions
{
    protected $code = 404;
    public const SHORT_MESSAGE = 'InsufficientWalletBalance';
    public const DESCRIPTION_MESSAGE = 'Saldo em conta insulficiente. A transferência será cancelada';

    public function __construct()
    {
        parent::__construct(
            self::SHORT_MESSAGE,
            self::DESCRIPTION_MESSAGE,
        );
    }
}
