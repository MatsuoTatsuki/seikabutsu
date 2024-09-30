<x-app-layout>
    <x-slot name="header">
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
        <script>
            function initMap() {
                var location = { lat: {{ $location['lat'] }}, lng: {{ $location['lng'] }} };

                var mapOptions = {
                    zoom: 14,
                    center: location
                };

                var map = new google.maps.Map(document.getElementById('map'), mapOptions);

                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        </script>
    </x-slot>

    <div class="container mx-auto p-6 grid grid-cols-3 gap-6">
        <!-- 左上の戻るボタン -->
        <div class="col-span-3">
            <a href="/" class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded-lg shadow">
                戻る
            </a>
        </div>

        <!-- 左の写真エリア -->
        <div class="col-span-1">
            @if($post->post_image)
            <img src="{{ $post->post_image }}" alt="画像がありません。" class="w-full h-auto mb-4 rounded-lg shadow-lg">
            @endif

            <!-- タグエリア -->
            <div class="space-y-2">
                @foreach($tags as $tag)
                <span class="block bg-gray-200 text-gray-700 px-4 py-2 rounded-lg shadow">{{ $tag->tag_name }}</span>
                @endforeach
            </div>
        </div>

        <!-- 右上の地図エリア -->
        <div class="col-span-2">
            <div id="map" class="w-full h-64 rounded-lg shadow-lg mb-4" style="height: 300px;"></div>
            <a href="/prefectures/{{ $post->prefecture->id }}" class="text-blue-500 hover:underline">
                {{ $post->prefecture->name }}
            </a>
        </div>

        <!-- 右下の本文エリア -->
        <div class="col-span-2">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-4">本文</h3>
                <p class="text-gray-700">{{ $post->body }}</p>
            </div>
        </div>
    </div>

    <!-- コメントセクション -->
    <div class="container mx-auto p-6">
        <!-- コメント投稿フォーム -->
        @auth
        <form action="/comments" method="POST" class="mb-6">
            @csrf
            <input type="hidden" name="comment[post_id]" value="{{ $post->id }}">
            <textarea name="comment[comment]" placeholder="コメントを入力してください" class="w-full p-4 rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 mb-4"></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">コメントを投稿</button>
        </form>
        @endauth

        <!-- コメント一覧 -->
        <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold mb-4">コメント</h3>
            @foreach($post->comments as $comment)
            <div class="mb-4">
                <div class="flex items-start space-x-4">
                    <!-- ユーザーアイコン -->
                    <img src="{{ $comment->user->profile_image ?? 'default_avatar.png' }}" class="w-10 h-10 rounded-full">
                    <div>
                        <!-- ユーザー名 -->
                        <p class="font-semibold">{{ $comment->user->name }}</p>
                        <!-- コメント本文 -->
                        <p class="text-gray-700">{{ $comment->comment }}</p>
                        <!-- 投稿日時 -->
                        <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
