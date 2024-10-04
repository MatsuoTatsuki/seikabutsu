<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary;
use App\Models\Message;
use App\Models\Community;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function index(Community $community)
    {
        $user = Auth::user();
        if (!$user->communities->contains($community->id)) {
            return redirect()->route('communities.index')->with('error', 'コミュニティに参加していません');
        }
        $messages = $community->messages()->with('user')->get();
        return view('communities.chat', compact('community', 'messages'));
    }

    public function store(Request $request, Community $community)
    {
        $request->validate([
            'message' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 画像のアップロード処理
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $imageUrl = $uploadedFileUrl;
        }

        Message::create([
            'community_id' => $community->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'image' => $imageUrl,
        ]);

        return redirect()->route('communities.chat', $community);
    }
}
