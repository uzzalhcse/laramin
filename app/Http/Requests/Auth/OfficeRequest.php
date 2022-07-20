<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
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
            'name' => 'required',
            'office_type' => 'required',
            'jurisdiction' => 'required',
            'division_id' => 'required_if:jurisdiction,division,district,upazila,union',
            'district_id' => 'required_if:jurisdiction,district,upazila,union',
            'upazila_id' => 'required_if:jurisdiction,upazila,union',
            'union_id' => 'required_if:jurisdiction,union',
            'status_id' => 'required',
        ];
    }
}
