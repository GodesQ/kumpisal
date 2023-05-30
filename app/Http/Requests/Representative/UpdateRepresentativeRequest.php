<?php

namespace App\Http\Requests\Representative;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRepresentativeRequest extends FormRequest
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
            'firstname' => 'required|max:30|min:2',
            'lastname' => 'required|max:30|min:2',
            'middlename' => 'required|max:30|min:2',
            'address' => 'nullable',
            'years_of_service' => 'required|numeric',
            'contact_no' => 'required',
            'birthdate' => 'required|date',
            'age' => 'required',
            'church' => 'required|exists:churches,id'
        ];
    }
}
