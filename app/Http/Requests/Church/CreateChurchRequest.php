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
            'description' => 'required',
            'church_image' => 'required|file|max:10000|mimes:png,jpeg,jpg',
            'address' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'diocese' => 'nullable',
            'parish_priest' => 'required',
            'feast_date' => 'required',
            'criteria' => 'nullable|in:diocese,vicariate',
            'contact_number' => 'nullable',
            'facebook_link' => 'nullable|url',
            'is_active' => 'nullable',
            'titular' => 'nullable',
            'diocese' => 'nullable|exists:dioceses,id',
            'monday_sched_starttime.*' => 'nullable',
            'monday_sched_endtime.*' => 'nullable|after:monday_sched_starttime.*',
            'tuesday_sched_starttime.*' => 'nullable',
            'tuesday_sched_endtime.*' => 'nullable|after:tuesday_sched_starttime.*',
            'wednesday_sched_starttime.*' => 'nullable',
            'wednesday_sched_endtime.*' => 'nullable|after:wednesday_sched_starttime.*',
            'thursday_sched_starttime.*' => 'nullable',
            'thursday_sched_endtime.*' => 'nullable|after:thursday_sched_starttime.*',
            'friday_sched_starttime.*' => 'nullable',
            'friday_sched_endtime.*' => 'nullable|after:friday_sched_starttime.*',
            'saturday_sched_starttime.*' => 'nullable',
            'saturday_sched_endtime.*' => 'nullable|after:saturday_sched_starttime.*',
            'sunday_sched_starttime.*' => 'nullable',
            'sunday_sched_endtime.*' => 'nullable|after:sunday_sched_starttime.*',
        ];
    }
    public function attributes()
    {
        return [
            'monday_sched_starttime.*' => 'Monday start time',
            'monday_sched_endtime.*' => 'Monday end time',
            'tuesday_sched_starttime.*' => 'Tuesday start time',
            'tuesday_sched_endtime.*' => 'Tuesday end time',
            'wednesday_sched_starttime.*' => 'Wednesday start time',
            'wednesday_sched_endtime.*' => 'Wednesday end time',
            'thursday_sched_starttime.*' => 'Thursday start time',
            'thursday_sched_endtime.*' => 'Thursday end time',
            'friday_sched_starttime.*' => 'Friday start time',
            'friday_sched_endtime.*' => 'Friday end time',
            'saturday_sched_starttime.*' => 'Saturday start time',
            'saturday_sched_endtime.*' => 'Saturday end time',
            'sunday_sched_starttime.*' => 'Sunday start time',
            'sunday_sched_endtime.*' => 'Sunday end time',
        ];
    }
}
