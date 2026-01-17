<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image'          => 'required|image|max:2048',
            'commodity_name' => 'required|string|max:255',
            'brand'          => 'nullable|string|max:255',
            'price'          => 'required|numeric|min:1',
            'category'       => 'required|string',
            'condition'      => 'required|string',
            'description'    => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '商品画像を選択してください',
            'image.image'    => '画像ファイルを選択してください',
            'image.max'      => '画像サイズは2MB以内にしてください',

            'commodity_name.required' => '商品名を入力してください',
            'price.required'          => '価格を入力してください',
            'price.numeric'           => '価格は数字で入力してください',
            'price.min'               => '価格は1円以上にしてください',

            'category.required'  => 'カテゴリーを選択してください',
            'condition.required' => '商品の状態を選択してください',
            'description.required' => '商品説明を入力してください',
        ];
    }
}
