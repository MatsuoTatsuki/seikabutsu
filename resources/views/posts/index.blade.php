<x-app-layout>
    
    <div class="container mx-auto flex flex-wrap lg:flex-nowrap gap-6">
        <!-- 左サイドバー -->
        <aside class="w-full lg:w-1/4 mt-16 sticky top-0 h-screen">
            <div class="bg-white shadow-md rounded-lg p-6 mt-16">
                <div class="text-center mb-6">
                    <img src="{{ auth()->user()->image ?? 'default_icon_url' }}" alt="{{ auth()->user()->name }}" class="w-20 h-20 rounded-full mx-auto mb-2">
                    <a href="{{ route('profile', auth()->user()->id) }}" class="hover:underline">
                        {{ auth()->user()->name }}
                    </a>
                </div>
                <!-- 検索フォーム -->
                <form action="{{ route('posts.search') }}" method="POST" class="mb-6">
                    @csrf
                    <input type="text" name="query" placeholder="場所を入力してください" class="w-full p-2 border border-gray-300 rounded mb-4">
                    <button type="submit" class="w-full bg-gray-500 text-white py-2 rounded hover:bg-gray-600">検索</button>
                </form>
                <!-- 絞り込み -->
                <form action="{{ route('posts.search') }}" method="GET" class="mb-6">
                    <label for="prefecture" class="block text-sm font-medium text-gray-700 mb-2">地域で絞り込み</label>
                    <select name="prefecture_id" id="prefecture" class="w-full p-2 border border-gray-300 rounded">
                        <option value="">すべての都道府県</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" @if(request('prefecture_id') == $prefecture->id) selected @endif>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="w-full bg-gray-500 text-white py-2 rounded mt-2 hover:bg-gray-600">絞り込む</button>
                </form>
            </div>
        </aside>

        <!-- メインコンテンツ -->
        <main class="w-full lg:w-2/4 mt-16">
            <a href="{{ route('create') }}" class="block bg-gray-500 text-white text-center py-2 rounded mb-6 hover:bg-gray-600">投稿する</a>

            <!-- 投稿一覧 -->
            <div id="post-list" class="space-y-6">
                @foreach ($posts as $post)
                    <div class="bg-white shadow-md rounded-lg p-6 post-item">
                        <!-- 投稿情報 -->
                        <div class="flex items-center mb-4">
                            <img src="{{ $post->user->image ?? 'default_icon_url' }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full">
                            <a href="{{ route('profile', $post->user->id) }}" class="ml-3 text-lg font-semibold hover:underline">{{ $post->user->name }}</a>
                        </div>
                        <!-- 投稿タイトル -->
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
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ページネーション -->
            @if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div id="pagination-links" class="flex justify-center mt-6">
                    {{ $posts->links('pagination::tailwind') }}
                </div>
            @endif
        </main>

        <!-- 右サイドバー - ユーザーランキング表示 -->
        <aside class="w-full lg:w-1/4 mt-16 sticky top-0 h-screen">
            <div class="bg-white shadow-md rounded-lg p-6 mt-16">
                <h2 class="text-lg font-semibold mb-4">ユーザーランキング</h2>
                <ul class="space-y-4">
                    @foreach ($rankedUsers as $rankedUser)
                        <li class="flex items-center">
                            <!-- 順位表示 -->
                            <span class="text-lg font-bold mr-2">{{ $rankedUser['rank'] }}.</span>
                            <!-- ユーザーアイコン -->
                            <img src="{{ $rankedUser['user']->image }}" alt="{{ $rankedUser['user']->name }}" class="w-10 h-10 rounded-full mr-3">
                            <!-- ユーザー名表示 -->
                            <div>
                                <a href="{{ route('profile', $rankedUser['user']->id) }}" class="font-semibold hover:underline">
                                    {{ $rankedUser['user']->name }}
                                </a>
                                <!-- いいね数表示 -->
                                <p class="text-sm text-gray-500">{{ $rankedUser['total_likes'] }} いいね</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>
</x-app-layout>
