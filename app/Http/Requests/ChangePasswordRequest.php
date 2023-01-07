<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::min(8)->letters()->numbers()],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->checkCurrentPassword()) {
                $validator->errors()->add('current_password', 'The provided password does not match your current password!');
            }
        });
    }

    /**
     * Check if user Password is correct
     *
     * @return bool
     */
    private function checkCurrentPassword()
    {
        return !Hash::check($this->current_password, Auth::user()->password);
    }

}
