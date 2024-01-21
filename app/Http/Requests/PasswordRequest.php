<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
            'confirmpassword' => [
                'required',
                'same:password',
            ],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Trường :attribute bắt buộc phải nhập.',
            'password.min' => 'Trường :attribute phải có ít nhất :min ký tự.',
            'password.regex' => 'Trường :attribute phải chứa ít nhất một ký tự thường, một ký tự hoa, một số, và một ký tự đặc biệt.',
            'confirmpassword.required' => 'Trường :attribute bắt buộc phải nhập.',
            'confirmpassword.same' => 'Trường :attribute phải giống với mật khẩu.',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'Mật khẩu',
            'confirmpassword' => 'Xác nhận mật khẩu',
        ];
    }
}
