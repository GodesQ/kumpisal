<?php

namespace App\Http\Requests\ConfessionSchedule;

use Illuminate\Foundation\Http\FormRequest;

class CreateConfessionScheduleRequest extends FormRequest
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
            'started_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i|after:started_time',
            'is_active' => 'nullable'
        ];
    }
}
