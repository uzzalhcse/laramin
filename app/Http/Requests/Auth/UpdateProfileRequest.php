<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
            'avatar_file' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'office_id' => 'required',
        ];
    }
}
