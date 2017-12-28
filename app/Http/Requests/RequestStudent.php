<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStudent extends FormRequest
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
                'id' =>'required|numeric',
                'name' => 'required|max:50|min:5|regex:/^[a-zA-Z]+$/u|max:255',
                'birthday' => 'required|date_format: "Y-m-d"',
                'address' => 'required|max:100',
                'class' => 'required|max:20',
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
                'name.required' => 'Bạn phải nhập tên',
                'birthday.required' => 'Sao không nhập email?',
                'required' => ':attribute chưa nhập',
                'max' => ':attribute không quá :max ký tự',
                'min' => ':attribute : hãy nhập đầy đủ :attribute',
                'date_format' => "Ngày sinh phải nhập đúng format ví dụ: 1997-03-04",
                'regex' => "Tên chỉ bao gồm chữ cái",
        ];
    }
}