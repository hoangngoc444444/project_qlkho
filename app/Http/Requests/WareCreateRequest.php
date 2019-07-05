<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WareCreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255','unique:wares'],
            'user_id' => ['required'],
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên kho hàng',
            'name.unique' => 'Tên kho hàng trùng, vui lòng chọn tên khác',
            'user_id.required' => 'Vui lòng chọn người quản lý',

        ];
    }
}
