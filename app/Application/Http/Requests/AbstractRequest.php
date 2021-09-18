<?php

namespace App\Application\Http\Requests;

use App\Domain\Transfer\Exceptions\InvalidFormDataException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new InvalidFormDataException($validator->errors()->toArray());
    }
}
