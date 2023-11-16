<?php

namespace Modules\Categories\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        return [
            'name' => 'required|max:255',
            'slug' =>  'required|max:255',
            'parent_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('categories::validation.required'),
            'max' => trans('categores::validation.max'),
            'integer' => trans('categories::validation.integer')
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('categories::validation.attributes.name'),
            'slug' => trans('categories::validation.attributes.slug'),
            'parent_id' => trans('categories::validation.attributes.parent_id')
        ];
    }
}
