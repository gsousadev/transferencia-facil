<?php

namespace App\Infrastructure\Transfer\Repositories\Integrators;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Infrastructure\Transfer\Repositories\ExternalAuthorizeServiceInterface;

class ExternalAuthorizeService implements ExternalAuthorizeServiceInterface
{
    public function verify(array $transaction): bool
    {
        try {
            $response = Http::get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');

            $responseBody = json_decode($response->body(), true);

            Log::channel('integration')->info(
                'Authorize User Transaction',
                [
                    'transaction_id' => data_get($transaction, 'id'),
                    'response' => $responseBody
                ]
            );

            if (data_get($responseBody, 'message') === 'Autorizado' && $response->ok()) {
                return true;
            }

            return false;
        } catch (\Throwable $throwable) {
            Log::channel('integration')->error(
                'Error Authorize User Transaction',
                [
                    'transaction_id' => data_get($transaction, 'id'),
                    'exception' => $throwable->getMessage(),
                    'code' => $throwable->getCode()
                ]
            );

            throw $throwable;
        }
    }
}
