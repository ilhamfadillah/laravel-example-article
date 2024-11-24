<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'exists:users,id'
            ],
            'code' => [
                'required',
                'unique:products,code,' . $this->uuid . ',uuid'
            ],
            'name' => [
                'required',
            ],
            'quantity' => [
                'required',
                'integer'
            ],
            'price' => [
                'required',
                'numeric'
            ],
            'description' => [
                'required'
            ],
        ];
    }

    public function getAllowedInput()
    {
        return $this->only([
            'uuid',
            'user_id',
            'code',
            'name',
            'description',
            'quantity',
            'price'
        ]);
    }
}
