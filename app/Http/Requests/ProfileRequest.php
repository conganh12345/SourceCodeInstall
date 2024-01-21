<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Đặt thành true nếu bạn muốn cho phép xử lý request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'string|max:30', // Tối đa 30 ký tự, kiểu chuỗi
            'last_name' => 'string|max:20',  // Tối đa 20 ký tự, kiểu chuỗi
            'address' => 'string|max:200',   // Tối đa 200 ký tự, kiểu chuỗi
        ];
    }

    public function messages()
    {
        return [
            'first_name.max' => 'Trường :attribute không được vượt quá 30 ký tự.',
            'first_name.string' => 'Trường :attribute phải là ký tự chuỗi.',
            'last_name.max' => 'Trường :attribute không được vượt quá 20 ký tự.',
            'last_name.string' => 'Trường :attribute phải là ký tự chuỗi.',
            'address.max' => 'Trường :attribute không được vượt quá 200 ký tự.',
            'address.string' => 'Trường :attribute phải là ký tự chuỗi.',


        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'Tên',
            'last_name' => 'Họ',
            'address' => 'Địa chỉ',
        ];
    }
}
