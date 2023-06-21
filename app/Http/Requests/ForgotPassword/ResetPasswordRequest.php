<?php

namespace App\Http\Requests\ForgotPassword;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'email' => 'required',
            'verify_token' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ];
    }
}
