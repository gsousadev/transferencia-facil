<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\BusinessExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

class ShopkeppersCannotSendMoneyException extends BaseExceptions
{
    protected $code = 422;
    public const SHORT_MESSAGE = 'ShopkeppersCannotSendMoney';
    public const DESCRIPTION_MESSAGE = 'Logistas não podem enviar dinheiro, apenas receber';

    public function __construct()
    {
        parent::__construct(
            self::SHORT_MESSAGE,
            self::DESCRIPTION_MESSAGE,
        );
    }
}
