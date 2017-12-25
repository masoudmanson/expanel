<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'identity_number' => 'required|unique:authorized,identity_number',
            'mobile' => 'required',
        ];
    }

    public function messages()
    {
        return [
          'unique' => 'این کد ملی قبلا در سیستم ثبت شده است'
        ];
    }
}
