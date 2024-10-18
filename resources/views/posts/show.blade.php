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
    <div class="container mx-auto p-4 flex">
        <div class="bg-white rounded-lg shadow-lg container mx-auto p-6 max-w-4xl mt-16 mb-16">
        
                <!-- グリッドレイアウト -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    <!-- 左側のエリア -->
                    <div class="col-span-1">
                        @if ($post->post_image)
                            <img src="{{ $post->post_image }}" alt="投稿画像" class="w-full h-auto max-h-96 object-cover mb-4 mx-auto">
                        @else
                            <img src="{{ asset('images/default.png') }}" alt="画像がありません。" class="w-full h-auto max-h-96 object-cover mb-4 mx-auto">
                        @endif
                        <div id="map" class="w-full h-32 mb-4" style="height: 150px;"></div>
                        <!-- 地域 -->
                        <p class="text-blue-500 hover:underline mb-2">{{ $post->prefecture->name }}</p>
                        <p class="text-gray-700">{{ $post->address}}</p>
                    </div>
            
                    <!-- 右側の本文エリア -->
                    <div class="col-span-1">
                        <!-- いいね -->
                        <div class="flex justify-end">
                            @if($post->isLikedByAuthUser())
                                <i class="fa-solid fa-heart like-btn liked text-red-500" id="like-btn-{{ $post->id }}"></i>
                            @else
                                <i class="fa-solid fa-heart like-btn" id="like-btn-{{ $post->id }}"></i>
                            @endif
                            <p class="ml-2" id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</p>
                        </div>
            
                        <!-- 本文 -->
                        <div class=" p-6 mt-4">
                            <h3 class="text-4xl font-semibold mb-4">{{ $post->title }}</h3>
                            <p class="text-gray-700">{{ $post->body }}</p>
                        </div>
                    </div>
                </div>

                
                <!-- コメント投稿フォーム -->
                @auth
                <form action="/comments" method="POST" class="mb-6">
                    @csrf
                    <input type="hidden" name="comment[post_id]" value="{{ $post->id }}">
                    <textarea name="comment[comment]" placeholder="コメントを入力してください" class="w-full p-4 rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 mb-4"></textarea>
                    <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">コメントを投稿</button>
                </form>
                @endauth

                <!-- コメント一覧 -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-4">コメント</h3>
                    @foreach($post->comments as $comment)
                    <div class="mb-4">
                        <div class="flex items-start space-x-4">
                            <!-- ユーザーアイコン -->
                            <img src="{{ $comment->user->image ?? 'default_avatar.png' }}" class="w-10 h-10 rounded-full">
                            <div>
                                <!-- ユーザー名 -->
                                <a href="{{ route('profile', $comment->user->id) }}" class="font-semibold hover:underline">
                                    <p>{{ $comment->user->name }}</p>
                                </a>
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
    </div>    
</x-app-layout>
