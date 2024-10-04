<x-app-layout>
    <div>
        <body>
            <h1>プロフィール画面</h1>
            <h2>{{ $user->name }}</h2>
            <form action="{{ route('profile_image.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            
                <label for="image">プロフィール画像をアップロード</label>
                <input type="file" name="image" id="image">
            
                <button type="submit">保存</button>
            </form>
                
            @if (auth()->user()->following->contains($user->id))
        <form action="{{ route('unfollow', $user) }}" method="POST">
            @csrf
            <button type="submit">フォロー解除</button>
        </form>
            @else
            <form action="{{ route('follow', $user) }}" method="POST">
                @csrf
                <button type="submit">フォロー</button>
            </form>
        @endif
    </div>
    <p>フォロワー <a href="{{ route('profile.followers', $user) }}">{{ $user->followers()->count() }}</a></p>
    <p>フォロー中 <a href="{{ route('profile.following', $user) }}">{{ $user->following()->count() }}</a></p>

       
    </body>
</x-app-layout>