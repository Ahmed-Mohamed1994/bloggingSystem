<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updatePostRequest extends FormRequest
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
            'title' => [
                'required',
                'min:2',
                Rule::unique('posts')->ignore($this->post)
            ],
            'post_category' => 'required',
            'post_status' => 'required',
            'image' => 'image',
            'editor1' => 'required'
        ];
    }
}
