<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|max:2048',
            'postal_code' => 'nullable|string|max:10',
            'address'     => 'nullable|string|max:255',
            'building'    => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max'      => '名前は255文字以内で入力してください',

            'image.image' => '画像ファイルを選択してください',
            'image.max'   => '画像サイズは2MB以内にしてください',

            'postal_code.max' => '郵便番号は10文字以内で入力してください',
            'address.max'     => '住所は255文字以内で入力してください',
            'building.max'    => '建物名は255文字以内で入力してください',
        ];
    }
}
