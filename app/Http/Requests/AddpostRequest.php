<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddpostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Đặt thành true để cho phép xử lý yêu cầu xác thực
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'slug' => 'required|string|max:100',
            'description' => 'nullable|string|max:200',
            'content' => 'required|string',
            'publish_date' => 'nullable|date',

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập :attribute.',
            'title.string' => ':Attribute phải là một chuỗi.',
            'title.max' => ':Attribute không được vượt quá 100 ký tự.',
            'slug.required' => 'Vui lòng nhập :attribute.',
            'slug.string' => ':Attribute phải là một chuỗi.',
            'slug.max' => ':Attribute không được vượt quá 100 ký tự.',
            'description.max' => ':Attribute không được vượt quá 200 ký tự.',
            'content.required' => 'Vui lòng nhập :attribute.',
            'content.string' => ':Attribute phải là một chuỗi.',
            'publish_date.date' => ':Attribute phải là một ngày hợp lệ.',


        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'slug' => 'Slug',
            'description' => 'Mô tả',
            'content' => 'Nội dung',
            'publish_date' => 'Ngày xuất bản',

        ];
    }
}
