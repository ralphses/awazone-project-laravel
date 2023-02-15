<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\UserContact;
use App\Models\Utility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => ['required','string', 'max:255', Rule::unique(User::class)->ignore(Auth::user()->id)],
            'phone' => ['required', Rule::unique(UserContact::class)->ignore(Auth::user()->userContact->id), 'regex:^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,7}$^'],
            'date_of_birth' => ['required', 'date'],
            'address' => ['required', 'string', 'max:300'],
            'zip_or_postal_code' => ['required', 'integer', 'max:100000', 'min:0'],
            'state' => ['required','string', 'max:50'],
            'province' => ['required','string', 'max:50'],
            'mainCurrency' => ['required','string', Rule::in(array_keys(Utility::AIBOPAY_ACCOUNT_CURRENCY))],
            'country' => ['required','string', 'max:50']
        ];
    }
}
