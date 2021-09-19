<?php

namespace App\Infrastructure\Transfer\Repositories\Integrators;

use Illuminate\Support\Facades\Http;
use Infrastructure\Transfer\Repositories\SendNotificationServiceInterface;

class SendNotificationService implements SendNotificationServiceInterface
{
    public function send(array $transaction): bool
    {
        $response = Http::get('http://o4d9z.mocklab.io/notify');

        $responseBody = json_decode($response->body(), true);

        if (data_get($responseBody, 'message') === 'Success' && $response->ok()) {
            return true;
        }

        return false;
    }
}
