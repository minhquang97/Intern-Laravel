<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestTeacher extends FormRequest
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
            'id' =>'required|numeric|unique:teachers',
            'name' => 'required|max:50|min:5|max:255',
            'email' => 'required|unique:teachers',
            'birthday' => 'required|date_format: "Y-m-d"',
            'password' => 'required|min:6',
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
            'unique' => 'Duplicate :attribute',
            'name.required' => 'Bạn phải nhập tên',
            'birthday.required' => 'Sao không nhập email?',
            'required' => ':attribute chưa nhập',
            'max' => ':attribute không quá :max ký tự',
            'min' => ':attribute : quá ngắn',
            'date_format' => "Ngày sinh phải nhập đúng format ví dụ: 1997-03-04",
        ];
    }
}
