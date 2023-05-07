<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'name' => 'required|string|max:50',
            'cpf' => 'required|string|max:14',
            'phone' => 'required|string|max:15',
            'paymentMethod' => 'required|string|in:card,ticket,pix',
            'value' => 'required|string',
            'holderName' => 'required_if:paymentMethod,card|string|max:50',
            'number' => 'required_if:paymentMethod,card|string|min:13|max:19',
            'expiryMonth' => 'required_if:paymentMethod,card|string|min:2|max:2',
            'expiryYear' => 'required_if:paymentMethod,card|string|min:4|max:4',
            'cvv' => 'required_if:paymentMethod,card|string|min:3|max:3',
            'installmentCount' => 'required_if:paymentMethod,card|string|min:1|max:1',
            'postalCode' => 'required_if:paymentMethod,card|string|min:8|max:9',
            'addressNumber' => 'required_if:paymentMethod,card|string|max:10',
            'addressComplement' => 'string|max:100',
        ];
    }
}
