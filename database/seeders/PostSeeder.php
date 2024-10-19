<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title' => 'サンプル投稿タイトル',
                'body' => 'これはサンプルの投稿内容です。',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'post_image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729327775/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_174847_rhjgt8.png',
                'prefecture_id' => 27,  // 対応する都道府県ID
                'user_id' => 1,  // 対応するユーザーID
                'address' => '大阪府大阪市北区梅田',
            ],
            [
                'title' => 'サンプル投稿タイトル',
                'body' => 'これはサンプルの投稿内容です。',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'post_image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329274/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_175914_ndug4i.png',
                'prefecture_id' => 27,  // 対応する都道府県ID
                'user_id' => 1,  // 対応するユーザーID
                'address' => '大阪府大阪市北区梅田',
            ],
            [
                'title' => 'サンプル投稿タイトル',
                'body' => 'これはサンプルの投稿内容です。',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'post_image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329294/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_175942_d3knpl.png',
                'prefecture_id' => 27,  // 対応する都道府県ID
                'user_id' => 1,  // 対応するユーザーID
                'address' => '大阪府大阪市北区梅田',
            ],
            [
                'title' => 'サンプル投稿タイトル',
                'body' => 'これはサンプルの投稿内容です。',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'post_image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329305/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_175957_furl7u.png',
                'prefecture_id' => 13,  // 対応する都道府県ID
                'user_id' => 2,  // 対応するユーザーID
                'address' => '大阪府大阪市北区梅田',
            ],
            [
                'title' => 'サンプル投稿タイトル',
                'body' => 'これはサンプルの投稿内容です。',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'post_image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329320/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_180025_xyayis.png',
                'prefecture_id' => 13,  // 対応する都道府県ID
                'user_id' => 2,  // 対応するユーザーID
                'address' => '大阪府大阪市北区梅田',
            ],
            [
                'title' => 'サンプル投稿タイトル',
                'body' => 'これはサンプルの投稿内容です。',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'post_image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329332/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_180942_mqlop4.png',
                'prefecture_id' => 1,  // 対応する都道府県ID
                'user_id' => 3,  // 対応するユーザーID
                'address' => '大阪府難波市',
            ],
            [
                'title' => 'サンプル投稿タイトル',
                'body' => 'これはサンプルの投稿内容です。',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'post_image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329340/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_181003_nrax9q.png',
                'prefecture_id' => 1,  // 対応する都道府県ID
                'user_id' => 3,  // 対応するユーザーID
                'address' => '大阪府難波市',
            ],
            [
                'title' => 'サンプル投稿タイトル',
                'body' => 'これはサンプルの投稿内容です。',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'post_image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329350/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_181316_cajzcp.png',
                'prefecture_id' => 23,  // 対応する都道府県ID
                'user_id' => 4,  // 対応するユーザーID
                'address' => '大阪府難波市',
            ],
            [
                'title' => 'サンプル投稿タイトル',
                'body' => 'これはサンプルの投稿内容です。',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'post_image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329359/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_181328_gngwtp.png',
                'prefecture_id' => 23,  // 対応する都道府県ID
                'user_id' => 4,  // 対応するユーザーID
                'address' => '大阪府難波市',
            ],
            [
                'title' => 'サンプル投稿タイトル',
                'body' => 'これはサンプルの投稿内容です。',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'post_image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329368/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_181342_ik6dnc.png',
                'prefecture_id' => 40,  // 対応する都道府県ID
                'user_id' => 5,  // 対応するユーザーID
                'address' => '大阪府難波市',
            ],
            

        ]);
    }
}
