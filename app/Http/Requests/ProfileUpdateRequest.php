<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [//070, 072, 073, 076, 079 (mobiltelefoni) 
            //starts_with:070,072,073,076,079  (not working..)
            'name' => ['string', 'max:255'],
            'phone_number' =>  ['required', 'numeric', 'digits:10', 'unique:users'],

            //'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
