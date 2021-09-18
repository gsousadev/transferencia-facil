<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

abstract class BaseExceptions extends Exception
{
    protected $shortMessage;
    protected $errors;

    protected function __construct(string $shortMessage, string $message, array $errors = [])
    {
        $this->shortMessage = $shortMessage;
        $this->message = $message;
        $this->errors = $errors;
    }

    public function render(): JsonResponse
    {
        $responseData =  [
            'shortMessage' => $this->shortMessage,
            'message' => $this->message
        ];

        if(!empty($this->errors)){
            $responseData['errors'] = $this->errors;
        }

        return response()->json($responseData, $this->getCode());
    }
}
