<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',50); // タイトル
            $table->text('body',300); // 本文
            $table->timestamps(); // 作成日時と更新日時
            $table->softDeletes(); // 論理削除用のdeleted_atカラム
            $table->string('post_image',300)->nullable(); // 投稿画像
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
