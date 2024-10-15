<x-app-layout>
    <div class="container mx-auto p-6">
        <!-- 3列のレイアウト -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- 左カラム: プロフィール画像、フォローボタン、フォロワー数 -->
            <div class="bg-gray-200 shadow-lg rounded-lg p-4 text-center mt-16 sticky top-0 h-screen">
                <!-- プロフィール画像 -->
                <div class="flex justify-center mb-4">
                    <img src="{{ $user->image ?? 'default_icon_url' }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full object-cover">
                </div>
                <h2 class="text-xl font-semibold">{{ $user->name }}</h2>

                <!-- フォローボタン -->
                @if(auth()->user()->following->contains($user->id))
                    <form action="{{ route('unfollow', $user) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">フォロー解除</button>
                    </form>
                @else
                    <form action="{{ route('follow', $user) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">フォロー</button>
                    </form>
                @endif

                <!-- フォロー数とフォロワー数 -->
                <div class="mt-4">
                    <p>フォロワー: <a href="{{ route('profile.followers', $user) }}">{{ $user->followers()->count() }}</a></p>
                    <p>フォロー中: <a href="{{ route('profile.following', $user) }}">{{ $user->following()->count() }}</a></p>
                </div>
            </div>

            <!-- 中央カラム: 過去の投稿 -->
            <div class="bg-gray-200 shadow-lg rounded-lg p-4 mt-16 overflow-y-auto h-screen">
                <h2 class="text-xl font-semibold mb-4">過去の投稿</h2>
                @foreach ($user->posts as $post)
                    <div class="mb-4">
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <!-- 投稿者情報 -->
                            <div class="flex items-center mb-4">
                                <img src="{{ $post->user->image ?? 'default_icon_url' }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full">
                                <a href="{{ route('profile', $post->user->id) }}" class="ml-3 text-lg font-semibold">{{ $post->user->name }}</a>
                            </div>
    
                            <!-- 投稿内容 -->
                            <h2 class="text-2xl font-bold mb-2">
                                <a href="/posts/{{ $post->id }}" class="hover:underline">{{ $post->title }}</a>
                            </h2>
                            
    
                            <!-- 投稿画像 -->
                            @if($post->post_image)
                                <img src="{{ $post->post_image }}" alt="投稿画像" class="w-full h-auto mb-4 rounded">
                            @endif
    
                            <!-- いいねとコメント数 -->
                            <div class="flex items-center space-x-6">
                                <!-- いいね -->
                                <div class="flex items-center">
                                    @if($post->isLikedByAuthUser())
                                        <i class="fa-solid fa-heart like-btn liked text-red-500" id="like-btn-{{ $post->id }}"></i>
                                    @else
                                        <i class="fa-solid fa-heart like-btn" id="like-btn-{{ $post->id }}"></i>
                                    @endif
                                    <p class="ml-2" id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</p>
                                </div>
    
                                <!-- コメント数 -->
                                <div class="flex items-center">
                                    <i class="fa-solid fa-comment"></i>
                                    <p class="ml-2">{{ $post->comments_count }} コメント</p>
                                </div>
                                 <!-- 投稿の削除ボタン（投稿者のみ表示） -->
                                @if(auth()->id() === $post->user_id)
                                    <form action="{{ route('delete', $post) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 ml-2">削除</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- 右カラム: 参加しているコミュニティ -->
            <div class="bg-gray-200 shadow-lg rounded-lg p-4 mt-16 overflow-y-auto h-screen">
                <h2 class="text-xl font-semibold mb-4">参加しているコミュニティ</h2>
                @foreach ($user->communities as $community)
                    <div class="mb-4">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <!-- コミュニティのアイコン -->
                            <div class="relative">
                                <img src="{{ $community->icon }}" alt="{{ $community->name }}" class="w-full h-48 object-cover object-center"> 
                            </div>
                            
                            <!-- コミュニティの内容 -->
                            <div class="p-4">
                                <!-- コミュニティ名 -->
                                <h3 class="text-lg font-bold mb-2">
                                    <p class="text-gray-600">
                                        {{ $community->name }}
                                    </p>
                                </h3>
                                
                                <!-- コミュニティの説明 -->
                                <p class="text-gray-600 text-sm mb-4">
                                    {{ $community->description }}
                                </p>
                                 <!-- コミュニティに参加しているかどうかをチェック -->
                                    @if(Auth::user()->communities->contains($community->id))
                                    <a href="{{ route('communities.chat', $community) }}" class="text-sm text-white bg-blue-500 px-4 py-2 rounded-md hover:bg-blue-600">コミュニティチャットへ</a>
                                    <form action="{{ route('communities.leave', $community) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-white bg-red-500 px-4 py-2 rounded-md hover:bg-red-600">コミュニティを抜ける</button>
                                    </form>
                                @else
                                    <form action="{{ route('communities.join', $community) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-sm text-white bg-green-500 px-4 py-2 rounded-md hover:bg-green-600">コミュニティに参加する</button>
                                    </form>
                                @endif
                                
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
