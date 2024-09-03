<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cloudinary;
use App\Models\Prefecture;


class PostController extends Controller
{
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
        return view('posts.index')->with(['posts' => $post->get()]);  
        //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    }

    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }

    public function create(Prefecture $prefecture)
    {
        return view('posts.create')->with(['prefectures' => $prefecture->get()]);
    }

    public function store(Request $request, Post $post)
    {
        $input = $request['post'];
        if($request->file('image')){
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        $post_image = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();  
        $input += ['post_image' => $post_image];
        }
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }

}
