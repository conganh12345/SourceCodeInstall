<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;


class AuthRequest extends FormRequest
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
                'first_name' => 'required|string|max:30',
                'last_name' => 'required|string|max:30',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:100',
                    'unique:users',
                    'ends_with:@gmail.com', // Kiểm tra email có kết thúc bằng "@gmail.com"
                ],
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
            'first_name.required' => 'Trường :attribute là bắt buộc.',
            'first_name.max' => 'Trường :attribute không được vượt quá :max ký tự.',

            'last_name.required' => 'Trường :attribute là bắt buộc.',
            'last_name.max' => 'Trường :attribute không được vượt quá :max ký tự.',

            'email.required' => 'Trường :attribute là bắt buộc.',
            'email.email' => 'Trường :attribute không đúng định dạng email.',
            'email.max' => 'Trường :attribute không được vượt quá :max ký tự.',
            'email.unique' => 'Trường :attribute đã tồn tại trong hệ thống.',
            'email.ends_with' => 'Trường :attribute phải là địa chỉ email của Gmail.',

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
            'first_name' => 'Họ',
            'last_name' => 'Tên',
            'email' => 'Địa chỉ Email',
            'password' => 'Mật khẩu',
            'confirmpassword' => 'Xác nhận mật khẩu',
        ];
    }
}
