<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions\IntegrationExceptions;

use Domain\Transfer\Exceptions\BaseExceptions;

class SendNotificationServiceException extends BaseExceptions
{
    public const SHORT_MESSAGE = 'SendNotificationService';
    public const DESCRIPTION_MESSAGE = 'Ocorreu um problema no envio de notificação';

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
