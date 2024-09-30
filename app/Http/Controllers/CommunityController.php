<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary;
use App\Models\Community;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::all();
        return view('communities.index', compact('communities'));
    }

    public function create()
    {
        return view('communities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // アイコンのアップロード処理
        $iconUrl = null;
        if ($request->hasFile('icon')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('icon')->getRealPath())->getSecurePath();
            $iconUrl = $uploadedFileUrl;
        }

        $community = Community::create([
            'name' => $request->name,
            'description' => $request->description,
            'owner_id' => auth()->id(),
            'icon' => $iconUrl,
        ]);

        $community->users()->attach(auth()->id());

        return redirect()->route('communities.chat', $community);
    }

    
}
