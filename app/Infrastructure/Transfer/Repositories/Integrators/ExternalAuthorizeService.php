<?php

namespace App\Infrastructure\Transfer\Repositories\Integrators;

use Illuminate\Support\Facades\Http;
use Infrastructure\Transfer\Repositories\ExternalAuthorizeServiceInterface;

class ExternalAuthorizeService implements ExternalAuthorizeServiceInterface
{
    public function verify(array $transaction): bool
    {
        $response = Http::get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');

        $responseBody = json_decode($response->body(), true);

        if (data_get($responseBody, 'message') === 'Autorizado' && $response->ok()) {
            return true;
        }

        return false;
    }
}
