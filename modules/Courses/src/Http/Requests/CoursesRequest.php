<?php

namespace Modules\Courses\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $courseId = $this->route()->course;

        $uniqueRule = 'unique:courses,code';

        if ($courseId)
        {
            $uniqueRule.= ','.$courseId;
        }

        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'detail' => 'required',
            'teacher_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) 
                {
                    $fail(trans('courses::validation.validate.select'));
                }
            }],
            'thumbnail' => 'required|max:255',
            'code' => 'required|max:255|'.$uniqueRule,
            'is_document' => 'required|integer',
            'supports' => 'required',
            'status' => 'required|integer',
            'categories' => 'required'
        ];

        return $rules;
    }

    public function messages()
    {
        return trans('courses::validation.validate');
    }

    public function attributes()
    {
        return trans('courses::validation.attributes');
    }
}
