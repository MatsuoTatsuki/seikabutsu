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
        'user_id,'

    ];

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function tags(){
        
        return $this->belongsToMany(Tag::class);
    }

    public function users(){
        
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
