<?php

namespace App\Http\Requests;

use App\Models\Utility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewUserKycDocRequest extends FormRequest
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
            'doc-type' => ['required', 'string', Rule::in(Utility::KYC_DOC_TYPE)],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:5048']
        ];
    }
}
