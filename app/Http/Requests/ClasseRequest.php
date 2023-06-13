<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClasseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required | unique:classes',
            'start' => 'required',
            'end' =>'required',
            'schedule' => 'required',
            'course_id' => ['required', Rule::exists('courses', 'id')]
        ];
    }
}
