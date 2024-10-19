<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunitySeeder extends Seeder
{
    public function run()
    {
        DB::table('communities')->insert([
            [
                'name' => 'Sample Community',
                'description' => 'これはサンプルコミュニティです.',
                'icon' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729327775/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_174847_rhjgt8.png',
                'owner_id' => 1,  
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Community',
                'description' => 'これはサンプルコミュニティです.',
                'icon' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329274/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_175914_ndug4i.png',
                'owner_id' => 1,  
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Community',
                'description' => 'これはサンプルコミュニティです.',
                'icon' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329332/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_180942_mqlop4.png',
                'owner_id' => 1,  
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Community',
                'description' => 'これはサンプルコミュニティです.',
                'icon' => 'https://res.cloudinary.com/dfjtayhga/image/upload/v1729329359/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-10-19_181328_gngwtp.png',
                'owner_id' => 1,  
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
