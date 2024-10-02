<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight">コミュニティ一覧</h2>
    </x-slot>

    <!-- コミュニティ作成リンク -->
    <div class="flex justify-end mb-4 px-6"> 
        <a href="{{ route('communities.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
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
                    
                    <!-- コミュニティのチャットリンク -->
                    <a href="{{ route('communities.chat', $community) }}" class="text-sm text-white bg-blue-500 px-4 py-2 rounded-md hover:bg-blue-600">
                        コミュニティチャットへ
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
