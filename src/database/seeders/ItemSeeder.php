<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\User;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(
            ['email' => 'seeduser@example.com'],
            ['name' => 'SeedUser', 'password' => bcrypt('password')]
            );
        $categories=[
            'ファッション', 
            '家電', 
            'インテリア', 
            'レディース', 
            'メンズ', 
            'コスメ', 
            '本', 
            'ゲーム', 
            'スポーツ',
            'キッチン',
            'ハンドメイド',
            'アクセサリー',
            'おもちゃ',
            'ベビー・キッズ',
        ];

        $items=[[
            'name' => '腕時計',
            'price' => 15000,
            'brand'=>'Rolax',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'image_path' => 'Armani+Mens+Clock.jpg',
            'condition'=>'良好',
            'categories'=>'メンズ ファッション',
            'user_id' => $user->id,
        ],
        [
            'name' => 'HDD',
            'price' => 5000,
            'brand'=>'西芝',
            'description' => '高速で信頼性の高いハードディスク',
            'image_path' => 'HDD+Hard+Disk.jpg',
            'condition'=>'目立った傷や汚れなし',
            'categories'=>'家電',
            'user_id' => $user->id,
        ],
        [
            'name' => '玉ねぎ3束',
            'price' => 300,
            'brand'=>'なし',
            'description' => '新鮮な玉ねぎ3束のセット',
            'image_path' => 'iLoveIMG+d.jpg',
            'condition'=>'やや傷や汚れあり',
            'categories'=>'キッチン',
            'user_id' => $user->id,
        ],
        [
            'name' => '革靴',
            'price' => 4000,
            'brand'=>'',
            'description' => 'クラシックなデザインの革靴',
            'image_path' => 'Leather+Shoes+Product+Photo.jpg',
            'condition'=>'状態が悪い',
            'categories'=>'メンズ ファッション',
            'user_id' => $user->id,
        ],
        [
            'name' => 'ノートPC',
            'price' => 45000,
            'brand'=>'',
            'description' => '高性能なノートパソコン',
            'image_path' => 'Living+Room+Laptop.jpg',
            'condition'=>'良好',
            'categories'=>'家電',
            'user_id' => $user->id,
        ],
        [
            'name' => 'マイク',
            'price' => 8000,
            'brand'=>'なし',
            'description' => '高音質のレコーディング用マイク',
            'image_path' => 'Music+Mic+4632231.jpg',
            'condition'=>'目立った傷や汚れなし',
            'categories'=>'おもちゃ',
            'user_id' => $user->id,
        ],
        [
            'name' => 'ショルダーバッグ',
            'price' => 3500,
            'brand'=>'',
            'description' => 'おしゃれなショルダーバッグ',
            'image_path' => 'Purse+fashion+pocket.jpg',
            'condition'=>'やや傷や汚れあり',
            'categories'=>'ファッション レディース',
            'user_id' => $user->id,
        ],
        [
            'name' => 'タンブラー',
            'price' => 500,
            'brand'=>'なし',
            'description' => '使いやすいタンブラー',
            'image_path' => 'Tumbler+souvenir.jpg',
            'condition'=>'状態が悪い',
            'categories'=>'キッチン インテリア',
            'user_id' => $user->id,
        ],
        [
            'name' => 'コーヒーミル',
            'price' => 500,
            'brand'=>'Starbacks',
            'description' => '手動のコーヒーミル',
            'image_path' => 'Waitress+with+Coffee+Grinder.jpg',
            'condition'=>'良好',
            'categories'=>'家電 キッチン',
            'user_id' => $user->id,
        ],
        [
            'name' => 'メイクセット',
            'price' => 2500,
            'brand'=>'',
            'description' => '便利なメイクアップセット',
            'image_path' => '外出メイクアップセット.jpg',
            'condition'=>'目立った傷や汚れなし',
            'categories'=>'コスメ',
            'user_id' => $user->id,
        ]];

        foreach ($items as $item){
            Item::create($item);
        }
    }
}
