<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_name' => ['required'],
            'unit_price' => ['required'],
            'quanity' => ['required'],
            'subtotal' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
