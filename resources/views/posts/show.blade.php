
<x-app-layout>
    <x-slot name="header">
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
        <script>
            function initMap() {
                // 緯度・経度をLaravelから取得
                var location = { lat: {{ $location['lat'] }}, lng: {{ $location['lng'] }} };
    
                // 地図のオプション
                var mapOptions = {
                    zoom: 14,
                    center: location
                };
    
                // 地図を表示
                var map = new google.maps.Map(document.getElementById('map'), mapOptions);
    
                // マーカーを設定
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        </script>
    </x-slot>
    <body>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <div>
            <img src="{{ $post->post_image }}" alt="画像がありません。">
        </div>
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>    
            </div>
        </div>
        <h3>地図</h3>
        <div id="map" style="height: 500px; width: 100%;"></div>
        <a href="/prefectures/{{ $post->prefecture->id }}">{{ $post->prefecture->name }}</a>
        <h5 class='tag'>
        @foreach($tags as $tag)   
            {{ $tag->tag_name }}
        @endforeach
        </h5>
        @auth
        @if($post->isLikedByAuthUser())
            <div class="flexbox">
                <i class="fa-solid fa-heart like-btn liked" id={{$post->id}}></i>
                <p class="count-num">{{$post->likes->count()}}</p>
            </div>
        @else
            <div class="flexbox">
                <i class="fa-solid fa-heart like-btn" id={{$post->id}}></i>
                <p class="count-num">{{$post->likes->count()}}</p>
            </div>
        @endif
        @endauth
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <h3>コメント</h3>
        <form action="/comments" method="post" >
            @csrf
            <input type="hidden" name='comment[post_id]' value="{{$post->id}}">
            <div class="body">
                <textarea name="comment[comment]" placeholder="コメントを入力してください"></textarea>
            </div>
            <input type="submit" value="store"/>
        </form>

        <div class='comments'>
            @foreach ($post->comments as $comment)
                <div class='comment.content'>
                    <p class='body'>{{ $comment->comment }}</p>
                </div>
            @endforeach
        </div>

    </body>
    </x-app-layout>
