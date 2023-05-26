<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SaveAdminProfileRequest extends FormRequest
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
            'username' => 'required|max:20',
            'firstname' => 'required|max:20',
            'lastname' => 'required|max:20',
            'middlename' => 'nullable',
            'is_verify' => 'nullable',
            'is_active' => 'nullable'
        ];
    }
}
