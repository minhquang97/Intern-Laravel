<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestClass extends FormRequest
{
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
            'id' =>'required|numeric',
            'subject_id' => 'required',
            'semester' => 'required|numeric',
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
            'numeric' => ':attribute only allow numeric',
        ];
    }
}
