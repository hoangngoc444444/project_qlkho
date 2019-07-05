<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required'],
            'productname' => ['required'],
            'productname.*' => ['required'],
            'quantity.*' => ['required','numeric','min:1','max:999'],

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên phiếu xuất nhập',
            'type.required' => 'Chọn loại xuất hay nhập kho',
            'productname.required' => 'Chọn sản phẩm mà nhập vào',
            'productname.*.required' => 'Nhập tên tất cả sản phẩm xuất nhập vào',
            'quantity.*.required' => 'Chọn số lượng cho tất cả các sản phẩm',
            'quantity.*.max' => 'Số lượng chọn tối đa 999 sản phẩm',
            'quantity.*.min' => 'Số lượng không được nhỏ hơn 1',
        ];
    }
}
