<?php

namespace App\Http\Requests\Diocese;

use Illuminate\Foundation\Http\FormRequest;

class CreateDioceseRequest extends FormRequest
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
            'name' => 'required',
            'area' => 'required|in:Luzon,Visayas,Mindanao',
            'bishop' => 'nullable',
            'address' => 'nullable',
            'contact_no' => 'nullable',
            'vicar_general' => 'nullable',
            'chancellor' => 'nullable'
        ];
    }
}
