<?php

namespace App\Http\Requests\Church;

use Illuminate\Foundation\Http\FormRequest;

class CreateChurchRequest extends FormRequest
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
            'address' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'parish_priest' => 'required',
            'feast_date' => 'required|date',
            'criteria' => 'required|in:diocese,vicariate',
            'is_active' => 'nullable',
        ];
    }
}
