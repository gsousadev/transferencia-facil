<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\IntegrationExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

class ExternalAuthorizationServiceException extends BaseExceptions
{
    public const SHORT_MESSAGE = 'ExternalAuthorizationService';
    public const DESCRIPTION_MESSAGE = 'Ocorreu um problema na autorização da transferencia. Tente novamente mais tarde.';

    public function __construct(int $originalCode = 400, string $originalMessage = '')
    {
        $this->message = $originalMessage;
        $this->code = $originalCode;

        parent::__construct(
            self::SHORT_MESSAGE,
            self::DESCRIPTION_MESSAGE,
        );
    }
}
