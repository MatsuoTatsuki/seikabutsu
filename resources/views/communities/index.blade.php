<x-app-layout>

    <!-- コミュニティ作成リンク -->
    <div class="flex justify-end mb-4 px-6"> 
        <a href="{{ route('communities.create') }}" class="bg-gray-500 text-white px-4 py-2 mt-16 rounded-md hover:bg-gray-600">
            コミュニティを作成する
        </a>
    </div>

    <!-- コミュニティ一覧 -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-6"> 
        @foreach($communities as $community)
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
                        <a href="{{ route('communities.chat', $community) }}" class="text-sm text-white bg-gray-500 px-4 py-2 rounded-md hover:bg-gray-600">コミュニティチャットへ</a>
                        <form action="{{ route('communities.leave', $community) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-white bg-gray-500 px-4 py-2 rounded-md hover:bg-gray-600">コミュニティを抜ける</button>
                        </form>
                    @else
                        <form action="{{ route('communities.join', $community) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-sm text-white bg-gray-500 px-4 py-2 rounded-md hover:bg-gray-600">コミュニティに参加する</button>
                        </form>
                    @endif
                    
                    
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
