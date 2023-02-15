<?php

namespace App\Http\Requests;

use App\Models\Utility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'type' => ['required', Rule::in(Utility::CARD_TYPE)],
            'card-number' => ['required', 'numeric', 'regex:(\d)'],
            'expiry-month' => ['required', 'string'],
            'bank-name' => ['required', 'string', Rule::in(Utility::BANKS)],
            'card-pin' => ['required', 'string', 'max:4', 'min:4', 'regex:(\d)'],
            'card-cvv' => ['required', 'string', 'max:3', 'min:3', 'regex:(\d)'],
        ];
    }
}
