<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $uniqueEmail = 'unique:users';
        if (session('id')) {
            $id = session('id');
            $uniqueEmail = Rule::unique('users', 'email')->ignore($id);
        }

        return [
            'name' => 'required|max:255',
            'email' => 'required|email|' . $uniqueEmail . '|max:255',
            'password' => 'nullable|min:8', // Đặt rule cho password là nullable
            'confirm_password' => 'nullable|same:password', // Đặt rule cho confirm_password là nullable và khớp với password (nếu được nhập)
            'role' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail('Bắt buộc phải chọn chức vụ');
                }
            }],
            'phonenumber' => ['required', 'numeric', 'digits_between:1,11']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp',
            'role.required' => 'Vui lòng chọn quyền',
            'phonenumber.required' => 'Vui lòng nhập số điện thoại',
            'phonenumber.numeric' => 'Số điện thoại chỉ được nhập số',
            'phonenumber.digits_between' => 'Số điện thoại không được dài quá 11 số'
        ];
    }
}
