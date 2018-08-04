<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addPostRequest extends FormRequest
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
            'title' => 'required|min:2|unique:posts,title',
            'post_category' => 'required',
            'image' => 'required|image',
            'editor1' => 'required'
        ];
    }
}
