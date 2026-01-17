<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrCreate(
            ['email' => 'seeduser@example.com'],
            ['name' => 'SeedUser', 'password' => bcrypt('password')]
        );

        $items = [
            [
                'name' => '腕時計',
                'price' => 15000,
                'brand' => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'image_path' => 'items/Armani+Mens+Clock.jpg',
                'condition' => '良好',
                'category' => 'メンズ, ファッション',
            ],
            [
                'name' => 'HDD',
                'price' => 5000,
                'brand' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'image_path' => 'items/HDD+Hard+Disk.jpg',
                'condition' => '目立った傷や汚れなし',
                'category' => '家電',
            ],
            [
                'name' => '玉ねぎ3束',
                'price' => 300,
                'brand' => 'なし',
                'description' => '新鮮な玉ねぎ3束のセット',
                'image_path' => 'items/iLoveIMG+d.jpg',
                'condition' => 'やや傷や汚れあり',
                'category' => 'キッチン',
            ],
            [
                'name' => '革靴',
                'price' => 4000,
                'brand' => '',
                'description' => 'クラシックなデザインの革靴',
                'image_path' => 'items/Leather+Shoes+Product+Photo.jpg',
                'condition' => '状態が悪い',
                'category' => 'メンズ, ファッション',
            ],
            [
                'name' => 'ノートPC',
                'price' => 45000,
                'brand' => '',
                'description' => '高性能なノートパソコン',
                'image_path' => 'items/Living+Room+Laptop.jpg',
                'condition' => '良好',
                'category' => '家電',
            ],
            [
                'name' => 'マイク',
                'price' => 8000,
                'brand' => 'なし',
                'description' => '高音質のレコーディング用マイク',
                'image_path' => 'items/Music+Mic+4632231.jpg',
                'condition' => '目立った傷や汚れなし',
                'category' => 'おもちゃ',
            ],
            [
                'name' => 'ショルダーバッグ',
                'price' => 3500,
                'brand' => '',
                'description' => 'おしゃれなショルダーバッグ',
                'image_path' => 'items/Purse+fashion+pocket.jpg',
                'condition' => 'やや傷や汚れあり',
                'category' => 'ファッション, レディース',
            ],
            [
                'name' => 'タンブラー',
                'price' => 500,
                'brand' => 'なし',
                'description' => '使いやすいタンブラー',
                'image_path' => 'items/Tumbler+souvenir.jpg',
                'condition' => '状態が悪い',
                'category' => 'キッチン, インテリア',
            ],
            [
                'name' => 'コーヒーミル',
                'price' => 500,
                'brand' => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'image_path' => 'items/Waitress+with+Coffee+Grinder.jpg',
                'condition' => '良好',
                'category' => '家電, キッチン',
            ],
            [
                'name' => 'メイクセット',
                'price' => 2500,
                'brand' => '',
                'description' => '便利なメイクアップセット',
                'image_path' => 'items/makeup_set.jpg',
                'condition' => '目立った傷や汚れなし',
                'category' => 'コスメ',
            ],
        ];

foreach ($items as $item) {
    Item::create([
        'name' => $item['name'],
        'price' => $item['price'],
        'brand' => $item['brand'],
        'description' => $item['description'],
        'image_path' => $item['image_path'],
        'condition' => $item['condition'],
        'category' => $item['category'],
        'user_id' => $user->id,
    ]);
}

}

}