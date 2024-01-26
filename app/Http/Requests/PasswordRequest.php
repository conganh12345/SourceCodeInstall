<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;
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
                PasswordRule::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->symbols(),   // Chứa cả chữ cái in hoa và chữ cái thường
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
            'password.required' => 'Trường :attribute là bắt buộc.',
            'password.min' => 'Trường :attribute phải có ít nhất :min ký tự.',
            'password.strong' => 'Trường :attribute phải chứa ít nhất một chữ cái thường, một chữ cái hoa, một số và một ký tự đặc biệt.',

            'confirmpassword.required' => 'Trường :attribute là bắt buộc.',
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
