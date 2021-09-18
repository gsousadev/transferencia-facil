<?php

namespace App\Http\Requests;

class StoreTransactionRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'value' => 'required|numeric',
            'from_user' => 'required|string|size:11',
            'to_user' => 'required|string|min:11|max:14'
        ];
    }

    public function messages()
    {
        return [
            'from_user.size' => 'Apenas CPFs podem fazer transferencias para outros usuários'
        ];
    }
}
