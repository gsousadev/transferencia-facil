<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories;

interface SendNotificationServiceInterface
{
    public function send(array $transaction): bool;
}

