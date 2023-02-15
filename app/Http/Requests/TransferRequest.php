<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'transfer-amount' => ['required', 'integer', 'min:100'],
            'transfer-bank' => ['required', 'string', 'regex:(\d)', 'max:3', 'min:3'],
            'transfer-account' => ['required', 'string', 'regex:(\d)', 'max:10', 'min:10'],
            'transfer-note' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'transfer-amount.required' => 'Amount not valid',
            'origin-account.required' => 'Funds origin account not selected',
            'transfer-account.required' => 'Destination account not valid',
        ];
    }



}
