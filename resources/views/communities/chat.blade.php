<x-app-layout>
    <div class="flex h-screen mt-16">
        <!-- 左1/3：コミュニティメンバーリスト -->
        <aside class="w-1/3 bg-gray-300 p-4 overflow-y-auto">
            <h2 class="text-xl font-semibold mb-4">メンバー</h2>
            <ul>
                @foreach($community->users as $member)
                    <li class="flex items-center mb-4">
                        <img src="{{ $member->image ?? 'default_icon_url' }}" alt="{{ $member->name }}" class="w-10 h-10 rounded-full mr-3">
                        <span class="text-gray-800">{{ $member->name }}</span>
                    </li>
                @endforeach
            </ul>
        </aside>

        <!-- 右2/3：チャット画面 -->
        <div class="w-2/3 flex flex-col">
            <!-- メッセージ一覧 -->
            <div class="flex-1 p-4 overflow-y-auto">
                @foreach($messages as $message)
                    <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }} mb-4">
                        @if ($message->user_id !== auth()->id())
                            <div class="flex flex-col items-center mr-2">
                                <span class="text-gray-600 text-xs mb-1">{{ $message->user->name }}</span>
                                <img src="{{ $message->user->image ?? 'default_icon_url' }}" alt="{{ $message->user->name }}" class="w-8 h-8 rounded-full">
                            </div>
                        @endif
                        <div class="bg-{{ $message->user_id === auth()->id() ? 'gray-800 text-white' : 'gray-300' }} p-3 rounded-lg max-w-xs">
                            <p class="text-sm">{{ $message->message }}</p>
                            <span class="text-xs text-gray-500">{{ $message->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        @if ($message->user_id === auth()->id())
                            <div class="flex flex-col items-center ml-2">
                                <span class="text-gray-600 text-xs mb-1">{{ $message->user->name }}</span>
                                <img src="{{ $message->user->image ?? 'default_icon_url' }}" alt="{{ $message->user->name }}" class="w-8 h-8 rounded-full">
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- チャット入力欄 -->
            <form action="{{ route('communities.chat.store', $community) }}" method="POST" enctype="multipart/form-data" class="bg-gray-200 p-4 border-t">
                @csrf
                <div class="flex items-center space-x-4">
                    <textarea name="message" rows="1" class="flex-1 border-gray-300 rounded-md focus:ring focus:ring-blue-200" placeholder="メッセージを入力..."></textarea>
                    <input type="file" name="image" class="text-sm text-gray-600">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">送信</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
