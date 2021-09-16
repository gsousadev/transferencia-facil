<?php

namespace App\Exceptions;

use Exception;

abstract class BaseExceptions extends Exception
{
    protected string $shortMessage;

    protected function __construct(string $shortMessage, string $message)
    {
        $this->shortMessage = $shortMessage;
        $this->message = $message;
    }

    public function render()
    {
        return response()->json(
            [
                'shortMessage' => $this->shortMessage,
                'message' => $this->message
            ], $this->getCode()
        );
    }
}
