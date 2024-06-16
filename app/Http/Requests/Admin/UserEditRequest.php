<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
        $userId = $this->route('user');
        $rules = [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $userId,
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:25',
                'regex:/^[a-zA-Z0-9_-]+$/',
                'unique:users,username,'. $userId,
            ],
            'ho' => ['required', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'ten' => ['required', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'ngaysinh' => 'date',
            'gioitinh' => ['required', 'in:0,1'],
            'diachi' => 'required|string',
            'dienthoai' => 'required|string|max:15|min:3',
        ];

        if ($this->has('isChangePw') && $this->input('isChangePw') == "1") {
            $rules["password"] = [
                'required',
                'string',
                'min:8',
                'regex:/^[a-zA-Z0-9]+$/',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/[a-z]/', $value)) {
                        $fail('Mật khẩu phải chứa ít nhất một chữ cái.');
                    }
                    if (!preg_match('/[0-9]/', $value)) {
                        $fail('Mật khẩu phải chứa ít nhất một số.');
                    }
                },
            ];
        }
        return $rules;
    }
    public function messages(){
        return [
            'email.required' => 'Email là bắt buộc.',
            'email.string' => 'Email phải là một chuỗi ký tự.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email này đã được sử dụng.',
    
            'username.required' => 'Tên người dùng là bắt buộc.',
            'username.string' => 'Tên người dùng phải là một chuỗi ký tự.',
            'username.min' => 'Tên người dùng phải có ít nhất 3 ký tự.',
            'username.max' => 'Tên người dùng không được vượt quá 25 ký tự.',
            'username.regex' => 'Tên người dùng chỉ được phép chứa chữ cái, số, gạch dưới và gạch ngang.',
            'username.unique' => 'Tên người dùng này đã được sử dụng.',
    
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu chỉ được phép chứa chữ cái và số.',
            'password.regex_alpha' => 'Mật khẩu phải chứa ít nhất một chữ cái.',
            'password.regex_num' => 'Mật khẩu phải chứa ít nhất một số.',

            'ho.required' => 'Họ là bắt buộc.',
            'ho.string' => 'Họ phải là một chuỗi ký tự.',
            'ho.max' => 'Họ không được vượt quá 50 ký tự.',
            'ho.regex' => 'Họ chỉ được chứa chữ cái và dấu.',
            'ten.required' => 'Tên là bắt buộc.',
            'ten.string' => 'Tên phải là một chuỗi ký tự.',
            'ten.max' => 'Tên không được vượt quá 50 ký tự.',
            'ten.regex' => 'Tên chỉ được chứa chữ cái và dấu.',
            'ngaysinh.date' => 'Ngày sinh phải là một ngày hợp lệ.',
            'gioitinh.required' => 'Giới tính là bắt buộc.',
            'gioitinh.in' => 'Giới tính không hợp lệ',
            'diachi.required' => 'Địa chỉ là bắt buộc.',
            'diachi.string' => 'Địa chỉ phải là một chuỗi ký tự.',
            'dienthoai.required' => 'Điện thoại là bắt buộc.',
            'dienthoai.string' => 'Điện thoại phải là một chuỗi ký tự.',
            'dienthoai.max' => 'Điện thoại không hợp lệ (vượt quá 15 số)',
            'dienthoai.min' => 'Điện thoại không hợp lệ (nhỏ hơn 3 số)',
        ];
    }
}
