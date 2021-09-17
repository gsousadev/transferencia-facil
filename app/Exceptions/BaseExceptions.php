<?php

declare(strict_types=1);

namespace App\Exceptions;

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
        return response()->json(
            [
                'shortMessage' => $this->shortMessage,
                'message' => $this->message,
                'errors' => $this->errors
            ], $this->getCode()
        );
    }
}
