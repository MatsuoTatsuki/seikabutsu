<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-semibold text-center mb-8">{{ __('ランキング') }}</h1>
    </x-slot>

    <div class="container mx-auto p-4 flex">
        <!-- 左側の住所検索フォーム -->
        <aside class="w-1/4 p-4 mt-16 bg-gray-100 rounded-lg mr-6">
            <div class="fixed top-0 left-0 w-1/4 mt-16 bg-gray-100 p-6 h-screen">
                <!-- アカウント情報 -->
                <div class="text-center mb-6">
                    <img src="{{ auth()->user()->image ?? 'default_icon_url' }}" alt="{{ auth()->user()->name }}" class="w-20 h-20 rounded-full mx-auto mb-2">
                    <a href="{{ route('profile', auth()->user()->id) }}">
                        {{ auth()->user()->name }}
                    </a>
                </div>
    
                <!-- 検索フォーム -->
                <form action="{{ route('posts.search') }}" method="POST" class="mb-6">
                    @csrf
                    <input type="text" name="query" placeholder="住所" class="w-full p-2 border border-gray-300 rounded mb-4">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">検索</button>
                </form>
            </div>
        </aside>
    
        <!-- ランキング一覧 -->
        <div class="w-3/4 space-y-6">
            @php
                $rank = 1; // 現在の順位
                $displayRank = 1; // 表示する順位
                $previousLikes = null; // 前回の投稿のいいね数
            @endphp
    
            @foreach ($posts as $post)
                @php
                    // いいね数が異なる場合のみ順位を更新
                    if ($previousLikes !== $post->likes_count) {
                        $displayRank = $rank;
                    }
                    $previousLikes = $post->likes_count;
                    $rank++;
                @endphp
    
                <!-- ランキング項目 -->
                <div class="bg-white shadow-lg rounded-lg p-4 flex items-start space-x-6" style="width: 400px; height: 420px; margin: 0 auto;">
                    <!-- ランキング表示 -->
                    <div class="text-2xl font-bold text-blue-500">
                        {{ $displayRank }}位
                    </div>
    
                    <!-- 投稿者のアイコンと情報 -->
                    <div class="flex-shrink-0">
                        <img src="{{ $post->user->image ?? 'default_icon_url' }}" alt="{{ $post->user->name }}" class="w-20 h-20 rounded-full object-cover">
                    </div>
    
                    <!-- 投稿の内容 -->
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="/posts/{{ $post->id }}" class="hover:text-blue-500">{{ $post->title }}</a>
                        </h2>
                        <p class="text-gray-600 text-sm mb-4">
                            投稿者: 
                            <a href="{{ route('profile', $post->user->id) }}" class="text-blue-500 hover:underline">
                                {{ $post->user->name }}
                            </a>
                        </p>
    
                        <!-- 投稿画像 -->
                        @if ($post->post_image)
                            <img src="{{ $post->post_image }}" alt="画像がありません。" class="w-full h-48 object-cover rounded-lg mb-2">
                        @else
                            <img src="{{ asset('images/default.png') }}" alt="画像がありません。" class="w-full h-48 object-cover rounded-lg mb-2">
                        @endif
    
                        <!-- いいね数とコメント数 -->
                        <div class="flex justify-between items-center text-gray-500 text-sm">
                            <div class="flex items-center">
                                <i class="fa-solid fa-heart mr-1 text-red-500"></i>
                                <span>{{ $post->likes_count }} いいね</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fa-solid fa-comments mr-1"></i>
                                <span>{{ $post->comments_count }} コメント</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
</x-app-layout>
