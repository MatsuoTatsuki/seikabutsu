<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
                    ['tag_name' => '甘め'],
                    ['tag_name' => '辛め'],
                    ['tag_name' => '普通'],
                    ['tag_name' => 'しょっぱい'],
                    ['tag_name' => '酸っぱい'],
                ]);
    }
}
