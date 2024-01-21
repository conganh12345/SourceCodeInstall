<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'email' => [
                'required',
                'string',
                'email',
                'max:100',

                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', // Kiểm tra email có phải là Gmail hay không
            ],

        ];
    }

    public function messages()
    {
        return [


            'email.required' => 'Trường :attribute bắt buộc phải nhập.',
            'email.email' => 'Trường :attribute không đúng định dạng email.',
            'email.max' => 'Trường :attribute không được vượt quá :max ký tự.',

            'email.regex' => 'Trường :attribute phải là địa chỉ email của Gmail.',


        ];
    }

    public function attributes()
    {
        return [


            'email' => 'Địa chỉ Email',

        ];
    }
}
