<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentProofRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'transaction_code' => ['required', 'string', 'max:255'],
            'payment_proof' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:1024'],
        ];
    }

    public function messages(): array
    {
        return [
            'payment_proof.required' => 'Please upload a payment proof image.',
            'payment_proof.image' => 'The payment proof must be a valid image.',
            'payment_proof.mimes' => 'Payment proof must be a jpeg, png, jpg, gif or webp image.',
            'payment_proof.max' => 'The payment proof must not be greater than 1 MB.',
        ];
    }
}
