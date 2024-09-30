<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrefectureController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ChatController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');


Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('posts/rankpost', 'rankpost')->name('rankpost');
    Route::post('/posts', 'store')->name('store');
    Route::post('/posts/search', 'searched')->name('searched');
    Route::get('/posts/searchprefecture', 'searchp')->name('posts.search');
    Route::get('/posts/create', 'create')->name('create');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::delete('/posts/{post}', 'delete')->name('delete');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
});

Route::controller(PrefectureController::class)->group(function(){
    Route::get('/prefectures/{prefecture}', 'index')->name('prefecture.index');
  
});

Route::controller(CommentController::class)->middleware(['auth'])->group(function(){
    Route::post('/comments', 'store')->name('comment.store');
  
});
Route::post('/posts/like', [LikeController::class, 'likePost']);
// Route::controller(LikeController::class)->middleware(['auth'])->group(function(){
//     Route::post('/like', 'likePost')->name('like.post');
  
// });

Route::controller(FollowController::class)->middleware(['auth'])->group(function(){
    Route::post('/follow/{user}', 'follow')->name('follow');
    Route::post('/unfollow/{user}', 'unfollow')->name('unfollow');
  
});

Route::controller(ProfileController::class)->middleware(['auth'])->group(function(){
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
    Route::get('/profile/{user}', 'show')->name('profile');
    Route::put('/profile/image', 'image')->name('profile_image.update');
    Route::get('/profile/{user}/following', 'following')->name('profile.following');
    Route::get('/profile/{user}/followers', 'followers')->name('profile.followers');
  
});

// コミュニティ関連のルート
Route::prefix('communities')->group(function () {
    Route::get('/', [CommunityController::class, 'index'])->name('communities.index'); // コミュニティ一覧
    Route::get('/create', [CommunityController::class, 'create'])->name('communities.create'); // コミュニティ作成ページ
    Route::post('/store', [CommunityController::class, 'store'])->name('communities.store'); // コミュニティの保存
    //Route::get('/{community}', [CommunityController::class, 'show'])->name('communities.show'); // コミュニティ詳細
});

// チャット関連のルート
Route::prefix('communities/{community}/chat')->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('communities.chat'); // コミュニティのチャットページ
    Route::post('/message', [ChatController::class, 'store'])->name('communities.chat.store'); // メッセージ送信
});



require __DIR__.'/auth.php';
