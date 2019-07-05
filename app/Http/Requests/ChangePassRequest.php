<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePassRequest extends FormRequest
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


        $rules = [
            'current_password' => 'required',
            'password' => 'required|same:password|confirmed',
            'password_confirmation' => 'required|same:password',
            'email' => 'required|email'
        ];
        if (Auth::user()->email) {
            unset($rules['email']);
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'password.required' => 'Nhập mật khẩu mới',
            'password.confirmed' => 'Yêu cầu xác thực mật khẩu chính xác',
            // 'email.required' => 'Yêu cầu nhập email vào',
            // 'email.email' => 'Yêu cầu nhập đúng định dạng email'
        ];
    }
}
