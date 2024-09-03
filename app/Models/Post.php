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
        'image_url',
        'prefecture_id',
    ];

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }
}
