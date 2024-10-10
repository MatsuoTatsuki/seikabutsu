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
use App\Models\User; 
use Illuminate\Support\Facades\DB; 



class PostController extends Controller
{
    public function index(Post $post, Request $request)//インポートしたPostをインスタンス化して$postとして使用。
    {
        
        // 都道府県のリストを取得
        $prefectures = Prefecture::all();
        
       
        $posts = $post->withCount('comments')->get();
       
        $selectedPrefecture = $request->input('prefecture_id', ''); // デフォルトは空

        // 投稿を取得（フィルタリングなどは任意）
        $posts = Post::when($selectedPrefecture, function ($query, $prefectureId) {
            return $query->where('prefecture_id', $prefectureId);
        })->get();

        // 総合いいね数でユーザーをランキング（同率順位対応）
        $topUsers = User::select('users.*')
        ->join('posts', 'users.id', '=', 'posts.user_id')
        ->join('likes', 'posts.id', '=', 'likes.post_id')
        ->selectRaw('users.id, users.name, users.image, COUNT(*) as total_likes')
        ->groupBy('users.id', 'users.name', 'users.image')
        ->orderBy('total_likes', 'desc')
        ->get();

        // 同率順位を考慮して順位を計算
        $rankedUsers = [];
        $rank = 1;
        $previousLikes = null;

        foreach ($topUsers as $index => $user) {
            // 同率順位をチェック
            if ($previousLikes !== null && $user->total_likes < $previousLikes) {
                $rank = $index + 1;  // ランクを更新
            }

            $rankedUsers[] = [
                'user' => $user,
                'rank' => $rank,
                'total_likes' => $user->total_likes
            ];

            $previousLikes = $user->total_likes;  // 直前のユーザーのいいね数を更新
        }

        return view('posts.index')->with([
            'posts' => $posts,
            'prefectures' => $prefectures,
            'selectedPrefecture' => $selectedPrefecture,
            'rankedUsers' => $rankedUsers,
        ]);

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

    public function rankpost(Post $post, int $limit_count = 10)
    {
        $posts = Post::withCount('likes')
        ->orderBy('likes_count', 'desc')
        ->limit($limit_count)
        ->get();

        return view('posts.rankpost', compact('posts'));
    }


    public function searched(Request $request)
    {
        $searchWord = $request->input('query');
        $posts = Post::where('address', 'LIKE', "%{$searchWord}%")->get();

        $geocodedAddresses = [];

        foreach ($posts as $post) {
            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => $post->address,
                'key' => env('GOOGLE_MAPS_API_KEY'),
            ]);

            if ($response->successful() && isset($response['results'][0]['geometry']['location'])) {
                $location = $response['results'][0]['geometry']['location'];
                $geocodedAddresses[] = [
                    'address' => $post->address,
                    'latitude' => $location['lat'],
                    'longitude' => $location['lng'],
                    'post_title' => $post->title,   // 投稿タイトル
                    'post_content' => $post->body, // 投稿内容
                    'user_name' => $post->user->name, // 投稿者名
                    'user_id' => $post->user->id, // 投稿者ID
                    'post_id' => $post->id, // 投稿ID
                    'post_image' => $post->post_image, // 投稿画像
                    'post_created_at' => $post->created_at, // 投稿日時
                    'post_updated_at' => $post->updated_at, // 更新日時
                    'post_likes' => $post->likes->count(), // いいね数
                    
                ];
            }
        }

        return view('posts.searched')->with(['addresses' => $geocodedAddresses]);
    }


    public function profile(Post $post,User $user)
    {
        return view('posts.profile')->with([
            'post' => $post,
            'tusers'=>$users,
            
        ]);
    }

    public function searchp(Request $request)
    {
        $query = Post::withCount('comments');

        // 都道府県でフィルタリング
        if ($request->filled('prefecture_id')) {
            $query->where('prefecture_id', $request->prefecture_id);
        }

        $posts = $query->get();
        $prefectures = Prefecture::all();

       // 総合いいね数でユーザーをランキング（同率順位対応）
       $topUsers = User::select('users.*')
       ->join('posts', 'users.id', '=', 'posts.user_id')
       ->join('likes', 'posts.id', '=', 'likes.post_id')
       ->selectRaw('users.id, users.name, users.image, COUNT(*) as total_likes')
       ->groupBy('users.id', 'users.name', 'users.image')
       ->orderBy('total_likes', 'desc')
       ->get();

       // 同率順位を考慮して順位を計算
       $rankedUsers = [];
       $rank = 1;
       $previousLikes = null;

       foreach ($topUsers as $index => $user) {
           // 同率順位をチェック
           if ($previousLikes !== null && $user->total_likes < $previousLikes) {
               $rank = $index + 1;  // ランクを更新
           }

           $rankedUsers[] = [
               'user' => $user,
               'rank' => $rank,
               'total_likes' => $user->total_likes
           ];

           $previousLikes = $user->total_likes;  // 直前のユーザーのいいね数を更新
       }

       return view('posts.index')->with([
           'posts' => $posts,
           'prefectures' => $prefectures,
           'rankedUsers' => $rankedUsers,
       ]);
    }

    public function delete(Post $post)
    {
        // 削除できるのは投稿者自身に限る
        if (auth()->id() === $post->user_id) {
            $post->delete();
            return redirect()->back()->with('message', '投稿を削除しました。');
        }

        return redirect()->back()->with('error', 'この投稿を削除する権限がありません。');
    }



}
