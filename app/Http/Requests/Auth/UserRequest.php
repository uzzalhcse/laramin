<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'office_id' => 'required',
            'status_id' => 'required',
            'permissions' => 'array',
            'role_ids' => 'required|array'
        ];
        if ($this->getMethod() == 'POST'){
            $rules += ['password' => 'required|required|string|confirmed|min:6'];
        } else{
            $rules['email'] = 'required|email|unique:users,email,'.$this->id;
        }
        return $rules;
    }
}
