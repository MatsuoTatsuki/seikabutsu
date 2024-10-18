<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // 東京都内の実在する住所のリスト
        $tokyo_addresses = [
            '東京都千代田区丸の内1丁目',
            '東京都港区芝公園4丁目2-8',
            '東京都渋谷区代々木神園町2-1',
            '東京都新宿区西新宿2丁目8-1',
            '東京都品川区大崎2丁目1-1',
            '東京都目黒区中目黒1丁目1-1',
            '東京都台東区上野公園7-20',
            '東京都目黒区中目黒3丁目6-2',
            '東京都江東区青海2丁目3-6',
            '東京都目黒区自由が丘2丁目15-22'
        ];

        // 存在するuser_idを取得
        $userIds = DB::table('users')->pluck('id')->toArray();

        // 10件のランダムなデータを挿入
        for ($i = 0; $i < 10; $i++) {
            DB::table('posts')->insert([
                'star' => $faker->numberBetween(0, 5),
                'title' => $faker->sentence(3),
                'body' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
                'like' => $faker->numberBetween(0, 100),
                'post_image' => null,  // post_imageはnull
                'prefecture_id' => 13, // 東京都のID（都道府県IDを13に固定）
                'user_id' => $faker->randomElement($userIds),
                'address' => $faker->randomElement($tokyo_addresses), // 東京都内の実在する住所をランダムに選択
            ]);
        }
    }
}