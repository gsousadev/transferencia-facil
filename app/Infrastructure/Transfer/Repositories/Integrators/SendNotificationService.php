<?php

namespace App\Infrastructure\Transfer\Repositories\Integrators;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Infrastructure\Transfer\Repositories\SendNotificationServiceInterface;

class SendNotificationService implements SendNotificationServiceInterface
{
    public function send(array $transaction): bool
    {
        try {
            $response = Http::get('http://o4d9z.mocklab.io/notify');

            $responseBody = json_decode($response->body(), true);

            Log::channel('integration')->info(
                'Notification User Transaction',
                [
                    'transaction_id' => data_get($transaction, 'id'),
                    'response' => $responseBody
                ]
            );

            if (data_get($responseBody, 'message') === 'Success' && $response->ok()) {
                return true;
            }

            return false;
        } catch (\Throwable $throwable) {
            Log::channel('integration')->error(
                'Error Notification User Transaction',
                [
                    'transaction_id' => data_get($transaction, 'id'),
                    'exception' => $throwable->getMessage(),
                    'code' => $throwable->getCode()
                ]
            );
        }
    }
}
