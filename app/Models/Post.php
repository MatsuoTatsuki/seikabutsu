<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'post_image',
        'prefecture_id',
        'user_id',
        'address',

    ];



    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function tags(){
        
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            // 中間テーブルの関連を解除
            $post->tags()->detach();
        });
    }

    public function user(){
        
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //post_likesテーブルへのリレーションメソッド。Postモデルのインスタンス＄postに、$post->likes->count()とすると記事のいいね数を取得できるようになった。
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
    //自身がいいねしているのかどうか判定するメソッド（しているならtrue,していないならfalseを返す）
    public function isLikedByAuthUser() :bool
    {
        //認証済ユーザーid（自身のid）を取得
        $authUserId = \Auth::id();
        //空の配列を定義。後続の処理で、いいねしたユーザーのidを全て格納していくときに使う。
        $likersArr = array();
       
        //$thisは言葉の似た通り、クラス自身を指す。具体的にはこのPostクラスをインスタンス化した際の変数のことを指す。（後続のビューで登場する$postになります）
        foreach($this->likes as $Like){
            //array_pushメソッドで第一引数に配列、第二引数に配列に格納するデータを定義し、配列を作成できる。
            //今回は$likersArrという空の配列にいいねをした全てのユーザーのidを格納している。
            array_push($likersArr,$Like->user_id);

        }
        //in_arrayメソッドを利用し、認証済ユーザーid（自身のid）が上記で作成した配列の中に存在するかどうか判定している
        if (in_array($authUserId,$likersArr)){
            //存在したらいいねをしていることになるため、trueを返す
            return true;
        }else{
            return false;
        }
    }

    

   
}
