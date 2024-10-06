<x-app-layout>
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
    <body>
        <div class="flex">
            <!-- 左側のリスト表示 -->
            <div class="w-1/3 p-4 overflow-y-auto h-screen mt-16">
              <h1 class="text-2xl font-bold mb-4">検索結果</h1>
              <div class="space-y-4">
                @foreach($addresses as $address)
                <div class="border p-4 shadow-lg">
                  <h2 class="text-xl font-semibold">{{ $address['post_title'] }}</h2>
                  <img src="{{ $address['post_image'] }}" alt="画像がありません。" class="w-full h-32 object-contain my-2">
                  <p class="text-gray-600">{{ $address['user_name'] }}</p>
                </div>
                @endforeach
              </div>
            </div>
         <!-- 右側のGoogleマップ -->
            <div class="w-2/3 h-screen mt-16">
                <div id="map" style="width: 100%; height: 100%;"></div>
        </div> 
    </body>
</x-app-layout>