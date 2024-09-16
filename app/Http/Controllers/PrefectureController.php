<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefecture;
use App\Models\Post;

class PrefectureController extends Controller
{
    public function index(Prefecture $prefecture)
    {

        // Postモデルから、特定の都道府県IDに一致する投稿を取得 
        $posts = Post::where('prefecture_id', $prefecture->id) 
        ->orderBy('updated_at', 'DESC') 
        ->get(); 
        // ビューにデータを渡す 
        return view('prefectures.index')->with(['posts' => $posts]);
    }
}
