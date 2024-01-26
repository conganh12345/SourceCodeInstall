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

                'ends_with:@gmail.com', // Kiểm tra email có kết thúc bằng "@gmail.com"
            ],

        ];
    }

    public function messages()
    {
        return [


            'email.required' => 'Trường :attribute là bắt buộc.',
            'email.email' => 'Trường :attribute không đúng định dạng email.',
            'email.max' => 'Trường :attribute không được vượt quá :max ký tự.',

            'email.ends_with' => 'Trường :attribute phải là địa chỉ email của Gmail.',


        ];
    }

    public function attributes()
    {
        return [


            'email' => 'Địa chỉ Email',

        ];
    }
}
