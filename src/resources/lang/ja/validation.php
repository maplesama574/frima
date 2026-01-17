<?php

return [
    'accepted'             => ':attributeを承認してください',
    'active_url'           => ':attributeは、有効なURLではありません',
    'after'                => ':attributeには、:dateより後の日付を入力してください',
    'after_or_equal'       => ':attributeには、:date以降の日付を入力してください',
    'alpha'                => ':attributeには、アルファベッドのみ使用できます',
    'alpha_dash'           => ":attributeには、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます",
    'alpha_num'            => ":attributeには、英数字('A-Z','a-z','0-9')が使用できます",
    'array'                => ':attributeには、配列を入力してください',
    'before'               => ':attributeには、:dateより前の日付を入力してください',
    'before_or_equal'      => ':attributeには、:date以前の日付を入力してください',
    'between'              => [
        'numeric' => ':attributeには、:minから、:maxまでの数字を入力してください',
        'file'    => ':attributeには、:min KBから:max KBまでのサイズのファイルを入力してください',
        'string'  => ':attributeは、:min文字から:max文字にしてください',
        'array'   => ':attributeの項目は、:min個から:max個にしてください',
    ],
    'boolean'              => ":attributeには、'true'か'false'を入力してください",
    'confirmed'            => ':attributeと一致しません',
    'date'                 => ':attributeは、正しい日付ではありません',
    'date_equals'          => ':attributeは:dateに等しい日付でなければなりません',
    'date_format'          => ":attributeの形式は、':format'と合いません",
    'different'            => ':attributeと:otherには、異なるものを入力してください',
    'digits'               => ':attributeは、:digits桁にしてください',
    'digits_between'       => ':attributeは、:min桁から:max桁にしてください',
    'dimensions'           => ':attributeの画像サイズが無効です',
    'distinct'             => ':attributeの値が重複しています',
    'email'                => ':attributeはメール形式で入力してください',
    'ends_with'            => ':attributeは、次のうちのいずれかで終わらなければなりません: :values',
    'exists'               => '選択された:attributeは、有効ではありません',
    'file'                 => ':attributeはファイルでなければいけません',
    'filled'               => ':attributeは必須です',
    'gt'                   => [
        'numeric' => ':attributeは、:valueより大きくなければなりません',
        'file'    => ':attributeは、:value KBより大きくなければなりません',
        'string'  => ':attributeは、:value文字より大きくなければなりません',
        'array'   => ':attributeの項目数は、:value個より大きくなければなりません',
    ],
    'gte'                  => [
        'numeric' => ':attributeは、:value以上でなければなりません',
        'file'    => ':attributeは、:value KB以上でなければなりません',
        'string'  => ':attributeは、:value文字以上でなければなりません',
        'array'   => ':attributeの項目数は、:value個以上でなければなりません',
    ],
    'image'                => ':attributeには、画像を入力してください',
    'in'                   => '選択された:attributeは、有効ではありません',
    'in_array'             => ':attributeが:otherに存在しません',
    'integer'              => ':attributeには、整数を入力してください',
    'ip'                   => ':attributeには、有効なIPアドレスを入力してください',
    'ipv4'                 => ':attributeはIPv4アドレスを入力してください',
    'ipv6'                 => ':attributeはIPv6アドレスを入力してください',
    'json'                 => ':attributeには、有効なJSON文字列を入力してください',
    'lt'                   => [
        'numeric' => ':attributeは、:valueより小さくなければなりません',
        'file'    => ':attributeは、:value KBより小さくなければなりません',
        'string'  => ':attributeは、:value文字より小さくなければなりません',
        'array'   => ':attributeの項目数は、:value個より小さくなければなりません',
    ],
    'lte'                  => [
        'numeric' => ':attributeは、:value以下でなければなりません',
        'file'    => ':attributeは、:value KB以下でなければなりません',
        'string'  => ':attributeは、:value文字以下でなければなりません',
        'array'   => ':attributeの項目数は、:value個以下でなければなりません',
    ],
    'max'                  => [
        'numeric' => ':attributeには、:max以下の数字を入力してください',
        'file'    => ':attributeには、:max KB以下のファイルを入力してください',
        'string'  => ':attributeは、:max文字以下にしてください',
        'array'   => ':attributeの項目は、:max個以下にしてください',
    ],
    'mimes'                => ':attributeには、:valuesタイプのファイルを入力してください',
    'mimetypes'            => ':attributeには、:valuesタイプのファイルを入力してください',
    'min'                  => [
        'numeric' => ':attributeには、:min以上の数字を入力してください',
        'file'    => ':attributeには、:min KB以上のファイルを入力してください',
        'string'  => ':attributeは:min文字以上で入力してください',
        'array'   => ':attributeの項目は、:min個以上にしてください',
    ],
    'multiple_of'          => 'The :attribute must be a multiple of :value',
    'not_in'               => '選択された:attributeは、有効ではありません',
    'not_regex'            => ':attributeの形式が無効です',
    'numeric'              => ':attributeには、数字を入力してください',
    'password'             => 'パスワードが正しくありません',
    'present'              => ':attributeが存在している必要があります',
    'regex'                => ':attributeには、有効な正規表現を入力してください',
    'required'             => ':attributeを入力してください',
    'required_if'          => ':otherが:valueの場合、:attributeを入力してください',
    'required_unless'      => ':otherが:values以外の場合、:attributeを入力してください',
    'required_with'        => ':valuesが指定されている場合、:attributeも入力してください',
    'required_with_all'    => ':valuesが全て指定されている場合、:attributeも入力してください',
    'required_without'     => ':valuesが指定されていない場合、:attributeを入力してください',
    'required_without_all' => ':valuesが全て指定されていない場合、:attributeを入力してください',
    'same'                 => ':attributeと:otherが一致しません',
    'size'                 => [
        'numeric' => ':attributeには、:sizeを入力してください',
        'file'    => ':attributeには、:size KBのファイルを入力してください',
        'string'  => ':attributeは、:size文字にしてください',
        'array'   => ':attributeの項目は、:size個にしてください',
    ],
    'starts_with'          => ':attributeは、次のいずれかで始まる必要があります:values',
    'string'               => ':attributeには、文字を入力してください',
    'timezone'             => ':attributeには、有効なタイムゾーンを入力してください',
    'unique'               => '指定の:attributeは既に使用されています',
    'uploaded'             => ':attributeのアップロードに失敗しました',
    'url'                  => ':attributeは、有効なURL形式で入力してください',
    'uuid'                 => ':attributeは、有効なUUIDでなければなりません',

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'=>'お名前',
        'email'=>'メールアドレス',
        'password'=>'パスワード',
        'description'=>'商品の説明',
        'brand'=>'ブランド名',
        'payment_method'=>'支払い方法',
        'commodity_name'=>'商品名',
        'image'=>'商品画像',
        'category'=>'カテゴリー',
        'condition'=>'状態',
        'price'=>'販売価格',
    ],
];
