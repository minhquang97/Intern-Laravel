<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSubject extends FormRequest
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

    public function rules()
    {
        return [
            'id' =>'required|numeric',
            'name' => 'required|max:50|min:2',
            'credits' => 'required|min:2|max:10|numeric',
        ];
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attribute chưa nhập',
            'max' => ':attribute không quá :max ký tự',
            'min' => ':attribute : quá ngắn',
            'numeric' => ':attribute phải ở dạng số',
        ];
    }
}
