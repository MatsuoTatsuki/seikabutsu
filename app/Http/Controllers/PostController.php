<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cloudinary;
use App\Models\Prefecture;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Support\Facades\Http;



class PostController extends Controller
{
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
        return view('posts.index')->with(['posts' => $post->get()]);  
        //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    }

    public function show(Post $post,Tag $tag,Comment $comment)
    {
        $tags = $post->tags;
        $address = $post->address;
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
             'address' => $address,
              'key' => $apiKey,
             ]);
        $location = $response->json()['results'][0]['geometry']['location'];

        return view('posts.show')->with([
            'post' => $post,
            'tags'=>$tags,
            'comment'=>$comment,
            'location'=>$location,
        ]);
        //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
        
    }



    public function create(Prefecture $prefecture,Tag $tag)
    {
        return view('posts.create')->with([
            'prefectures' => $prefecture->get(),
            'tags'=>$tag->get()
        ]);
    }

    public function store(Request $request, Post $post,Tag $tag)
    {
        $input = $request['post'];
        $post->user_id = auth()->user()->id;
        $input_tags = $request->tags_array;
        if($request->file('image')){
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        $post_image = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += ['post_image' => $post_image];
        }
        $post->fill($input)->save();
        $post->save();
        $post->tags()->attach($input_tags); 
        return redirect('/posts/' . $post->id);
    }

    public function rankpost(Post $post)
    {
        $posts = Post::withCount('likes')
        ->orderBy('likes_count', 'desc')
        ->get();

        return view('posts.rankpost', compact('posts'));
    }

}
