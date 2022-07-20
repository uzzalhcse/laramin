<?php

namespace App\Http\Requests\Auth;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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

            'current_password' => ['required', new MatchOldPassword()],
            'new_password' => 'required|string|min:8|different:current_password',
            'password_confirmation' => 'required|same:new_password'
        ];
    }
}
