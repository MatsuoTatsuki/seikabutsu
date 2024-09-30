<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(User $user)
    {
        // フォロー状態も渡す
        $isFollowing = auth()->user()->following->contains($user->id);
        return view('posts.profile', compact('user', 'isFollowing'));
    }

    public function image(Request $request)
    {
        $user = auth()->user();

        // 画像がアップロードされた場合
        if ($request->hasFile('image')) {
            // Cloudinaryに画像をアップロード
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();

            // 画像のURLをデータベースに保存
            $user->image = $uploadedFileUrl;
            $user->save();
        }

        return redirect()->back()->with('success', 'プロフィール画像を更新しました！');
    }


    public function following(User $user)
    {
        // ユーザーがフォローしているユーザーの一覧を取得
        $followingUsers = $user->following()->get();

        return view('profile.following', compact('user', 'followingUsers'));
    }

    // フォロワーユーザー一覧を表示
    public function followers(User $user)
    {
        // ユーザーをフォローしているフォロワーの一覧を取得
        $followerUsers = $user->followers()->get();

        return view('profile.followers', compact('user', 'followerUsers'));
    }
    

    
}
