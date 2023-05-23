<?php

namespace App\Http\Requests\Church;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChurchRequest extends FormRequest
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
            'name' => 'required|max:100',
            'description' => 'required',
            'address' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'parish_priest' => 'required',
            'feast_date' => 'required|date',
            'criteria' => 'required|in:diocese,vicariate',
            'contact_number' => 'nullable',
            'facebook_link' => 'nullable',
            'is_active' => 'nullable',
        ];
    }
}
