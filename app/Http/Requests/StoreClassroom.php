<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroom extends FormRequest
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
            '*.class_name' => 'required|string',
            '*.class_name_en' => 'required|string',
            '*.grade_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'class_name.required' => trans('validation.required'),
            'class_name_en.required' => trans('validation.required'),
        ];
    }
}
