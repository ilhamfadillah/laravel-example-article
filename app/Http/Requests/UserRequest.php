<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $this->uuid . ',uuid'
            ],
            'password' => [
                'required',
                'string',
                'min:8'
            ]
        ];
    }

    public function getAllowedInput()
    {
        return $this->only([
            'uuid',
            'name',
            'email',
            'password',
        ]);
    }
}
