<x-app-layout>
    <div class="container mx-auto p-6 max-w-5xl">        
        <ul class="space-y-4 mt-16">
            <h2 class="text-center text-2xl font-semibold mb-2">{{ $user->name }} のフォロー中のユーザー</h2>
            @foreach($followingUsers as $followingUser)
                <li class="flex items-center bg-white p-4 rounded-lg shadow-lg mb-16">
                    <!-- ユーザーのアイコンを表示 -->
                    <img src="{{ $followingUser->image ?? 'default_icon_url' }}" alt="{{ $followingUser->name }}" class="w-12 h-12 rounded-full mx-auto mr-4">

                    <!-- ユーザー名、フォロワー数、フォロー中の数を横並びに表示 -->
                    <div class="flex-1">
                        <!-- ユーザー名 -->
                        <a href="{{ route('profile', $followingUser->id) }}" class="text-lg font-semibold text-gray-800 hover:underline">{{ $followingUser->name }}</a>
                        
                        <!-- フォロワー数とフォロー中 -->
                        <div class="text-gray-600 text-sm mt-1">
                            <span>フォロワー: {{ $followingUser->followers()->count() }}</span>
                            <span class="ml-4">フォロー中: {{ $followingUser->following()->count() }}</span>
                        </div>
                    </div>

                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
