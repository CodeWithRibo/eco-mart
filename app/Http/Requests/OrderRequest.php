<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required'],
            'total_amount' => ['required'],
            'payment_method' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
