<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => '大阪太郎',
                'email' => 'osaka@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729331676/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_185334_nfuvfp.png',
                
            ],
            [
                'name' => '東京太郎',
                'email' => 'tokyo@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729331667/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_185320_e8nn4s.png',

            ],
            [
                'name' => 'テスト',
                'email' => 'test@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729331683/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_185345_wxxdd6.png',
            ],
            [
                'name' => '愛知太郎',
                'email' => 'aichi@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729331689/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_185355_p4qsx9.png',
            ],
            [
                'name' => '福岡太郎',
                'email' => 'fukuoka@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'image' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729331693/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_185404_pe0gyq.png',
            ],
        ]);
    }
}
