<x-app-layout>
    <x-slot name="header">
        {{ __('検索結果') }}
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
        <script>
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: {lat: 35.6803997, lng: 139.7690174} // 任意の初期位置（例：東京）
                });
    
                // LatLngBoundsで地図範囲を設定
                var bounds = new google.maps.LatLngBounds();
    
                // マーカーごとに異なる色を設定（異なる色のピンを使用）
                var markerColors = [
                    "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
                    "http://maps.google.com/mapfiles/ms/icons/orange-dot.png",
                    "http://maps.google.com/mapfiles/ms/icons/purple-dot.png",
                    "http://maps.google.com/mapfiles/ms/icons/pink-dot.png",
                    "http://maps.google.com/mapfiles/ms/icons/ltgreen-dot.png"
                ];
    
                @foreach($addresses as $index => $address)
                    
                    var position = {lat: {{ $address['latitude'] }}, lng: {{ $address['longitude'] }}};
                    var markerColor = markerColors[{{ $loop->index }} % markerColors.length];
                    var markerAddress = '{{ $address['address'] }}';
                    var markerTitle = '{{ $address['post_title'] }}';
                    var markerContent = '{{ $address['post_content'] }}';
    
                    // マーカーを作成
                    var marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: markerAddress,
                        icon: markerColor
                    });
    
                    // InfoWindowの作成
                    var contentString = `
                        <div>
                            <h3>${markerAddress}</h3>
                            <p>投稿タイトル: ${markerTitle}</p>
                            <p>投稿内容: ${markerContent}</p>
                        </div>
                    `;
    
                    // 関数を使ってスコープを固定
                    (function(marker, contentString) {
                        var infoWindow = new google.maps.InfoWindow({
                            content: contentString
                        });
    
                        // ピンがクリックされたときにInfoWindowを表示
                        marker.addListener('click', function() {
                            infoWindow.open(map, marker);
                        });
                    })(marker, contentString);
    
                    // Boundsに位置を追加
                    bounds.extend(position);
                @endforeach
    
                // 地図の範囲をマーカー全体にフィットさせる
                map.fitBounds(bounds);
            }
        </script>
    </x-slot>
    <body>
        <div>
            <form action="/posts/search" method="POST">
              
                @csrf
              
                <input type="text" name="query" placeholder="住所"/>
                <input type="submit" value="検索">
            </form>
        </div>
        <h1>検索結果</h1>
        <div id="map" style="height: 500px; width: 500px;"></div>
        <h1>結果一覧</h1>
        <div class='posts'>
            @foreach ($addresses as $address)
            <h3>
                <a href="{{ route('profile', $address['user_id']) }}">
                    {{ $address['user_name'] }}
                </a>
            </h3>
                <div class='post'>
                <h2 class='title'>
                    <a href="/posts/{{ $address['post_id'] }}">{{ $address['post_title'] }}</a>
                </h2>
                <div>
                    <img src="{{ $address['post_image'] }}" alt="画像がありません。">
                </div>
                    <p class='body'>{{ $address['post_content'] }}</p>
                </div>
            @endforeach
        </div>
    </body>
</x-app-layout>