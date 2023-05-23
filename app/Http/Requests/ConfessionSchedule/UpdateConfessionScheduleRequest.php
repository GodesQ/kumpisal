<?php

namespace App\Http\Requests\ConfessionSchedule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfessionScheduleRequest extends FormRequest
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
            'schedule_date' => 'required|date',
            'started_time' => 'required',
            'end_time' => 'required|after:started_time',
            'is_active' => 'nullable'
        ];
    }
}
