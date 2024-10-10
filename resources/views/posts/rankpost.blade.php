<x-app-layout>

    <div class="container mx-auto px-4 mt-8">
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-16">
            @php
                $rank = 1; // 現在の順位
                $displayRank = 1; // 表示する順位
                $previousLikes = null; // 前回の投稿のいいね数
            @endphp
    
            @foreach ($posts as $post)
                @php
                    // いいねが変わる場合にのみ順位を更新
                    if ($previousLikes != $post->likes_count) {
                        $displayRank = $rank;
                        $previousLikes = $post->likes_count;
                    }
                    $rank++;
                @endphp
    
                <!-- ランキング項目 -->
                <div class="relative bg-white shadow-lg rounded-lg p-4 flex flex-col items-center">
                    <!-- ランキング表示 -->
                    <span class="absolute top-2 left-2 bg-yellow-500 text-white text-sm font-bold rounded-full px-3 py-1">
                        {{ $displayRank }}位
                    </span>
                    <!-- 投稿画像 -->
                    @if ($post->post_image)
                        <img src="{{ $post->post_image }}" alt="投稿画像" class="w-full h-48 object-cover rounded-lg mb-4">
                    @else
                        <img src="{{ asset('images/default.png') }}" alt="画像がありません。" class="w-full h-full object-cover mb-4">
                    @endif
    
                    <!-- 投稿者のアイコンと情報 -->
                <div class="flex items-center mb-4">
                    <img src="{{ $post->user->image ?? 'default_icon_url' }}" alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full object-cover mr-2">
                    <a href="{{ route('profile', $post->user->id) }}" class="text-blue-500 hover:underline">{{ $post->user->name }}</a>
                </div>
    
                    <!-- 投稿の内容 -->
                    <h2 class="text-lg font-semibold mb-2">
                        <a href="/posts/{{ $post->id }}" class="hover:text-blue-500">{{ $post->title }}</a>
                    </h2>
    
                    <!-- いいね数とコメント数 -->
                    <div class="flex justify-between w-full text-gray-500 text-sm">
                        <div class="flex items-center">
                            <i class="fa-solid fa-heart text-red-500 mr-1"></i>
                            <span>{{ $post->likes_count }} いいね</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-comments mr-1"></i>
                            <span>{{ $post->comments_count }} コメント</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    
    
</x-app-layout>
