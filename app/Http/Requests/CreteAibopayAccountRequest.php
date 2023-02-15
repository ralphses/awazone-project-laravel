<?php

namespace App\Http\Requests;

use App\Models\Utility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreteAibopayAccountRequest extends FormRequest
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
            'full-name' => ['required', 'string'],
            'currency' => ['required', 'string', Rule::in(array_values(Utility::AIBOPAY_ACCOUNT_CURRENCY))],
            'type' => ['required', Rule::in(Utility::AIBOPAY_ACCOUNT_TYPE)],
            'bvn' => ['required', 'string', 'max:99999999999', 'min:10000000000', 'numeric']
        ];
    }
}
