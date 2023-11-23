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
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'detail' => 'required',
            'teacher_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) 
                {
                    $fail(trans('courses::validation.select'));
                }
            }],
            'thumbnail' => 'required|max:255',
            'code' => 'required|max:255',
            'is_document' => 'required|integer',
            'supports' => 'required',
            'status' => 'required|integer',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => trans('courses::validation.required'),
            'max' => trans('courses::validation.max'),
            'integer' => trans('courses::validation.integer')
        ];
    }

    public function attributes()
    {
        return trans('courses::validation.attributes');
    }
}
