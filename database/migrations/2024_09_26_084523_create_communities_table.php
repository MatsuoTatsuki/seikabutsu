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
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // コミュニティ名
            $table->text('description')->nullable(); // コミュニティの説明
            $table->string('icon')->nullable(); // CloudinaryのアイコンURL
            $table->unsignedBigInteger('owner_id'); // コミュニティの作成者
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communities');
    }
};
