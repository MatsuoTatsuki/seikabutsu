<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    public function likePost(Request $request)
    {
        
        $user_id = \Auth::id();
        //jsのfetchメソッドで記事のidを送信しているため受け取ります。
        $post_id = $request->post_id;
        //自身がいいね済みなのか判定します
        $alreadyLiked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first();

        if (!$alreadyLiked) {
        //こちらはいいねをしていない場合の処理です。つまり、post_likesテーブルに自身のid（user_id）といいねをした記事のid（post_id）を保存する処理になります。
            $post = Post::find($post_id);
            
            $post->likes()->attach($user_id);
        } else {
            //すでにいいねをしていた場合は、以下のようにpost_likesテーブルからレコードを削除します。
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        //ビューにその記事のいいね数を渡すため、いいね数を計算しています。
        $post = Post::where('id', $post_id)->first();
        $likesCount = $post->likes->count();
        
        $param = [
            'likesCount' =>  $likesCount,
        ];
        //ビューにいいね数を渡しています。名前は上記のlikesCountとなるため、フロントでlikesCountといった表記で受け取っているのがわかると思います。
        return response()->json($param);
    }
}
