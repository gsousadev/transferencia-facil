<?php

declare(strict_types=1);

namespace Domain\Transfer\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

abstract class BaseExceptions extends Exception
{
    protected $shortMessage;
    protected $errors;
    protected $description;

    protected function __construct(string $shortMessage, string $description, array $errors = [])
    {
        $this->shortMessage = $shortMessage;
        $this->description = $description;
        $this->errors = $errors;
    }

    public function render(): JsonResponse
    {
        $responseData =  [
            'originalMessage' => $this->message,
            'shortMessage' => $this->shortMessage,
            'description'=> $this->description
        ];

        if(!empty($this->errors)){
            $responseData['errors'] = $this->errors;
        }

        return response()->json($responseData, $this->getCode());
    }
}
