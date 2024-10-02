<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ $community->name }} のチャット
        </h2>
    </x-slot>

    <div class="chat-messages space-y-4 px-6 py-4">
        @foreach($messages as $message)
            <!-- チャットメッセージを右か左に分ける -->
            <div class="flex {{ $message->user->id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                <!-- ユーザーのアイコン -->
                <div class="flex items-center space-x-4">
                    @if($message->user->id != auth()->id())
                        <img src="{{ $message->user->image ?? 'default_icon_url' }}" alt="{{ $message->user->name }}" class="w-10 h-10 rounded-full">
                    @endif
                    <div class="max-w-xs lg:max-w-md">
                        <!-- 吹き出し部分 -->
                        <div class="{{ $message->user->id == auth()->id() ? 'bg-gray-300 text-black' : 'bg-gray-300 text-black' }} rounded-lg p-4">
                            <!-- メッセージ送信者の名前 -->
                            <strong class="text-sm block {{ $message->user->id == auth()->id() ? 'text-right' : '' }}">
                                {{ $message->user->name }}
                            </strong>

                            <!-- メッセージ内容 -->
                            @if($message->message)
                                <p class="text-sm {{ $message->user->id == auth()->id() ? 'text-right' : '' }}">
                                    {{ $message->message }}
                                </p>
                            @endif

                            <!-- 画像がある場合 -->
                            @if($message->image)
                                <div class="mt-2">
                                    <img src="{{ $message->image }}" alt="画像" class="w-40 h-40 object-cover rounded-md">
                                </div>
                            @endif

                            <!-- コメントの投稿時間 -->
                            <div class="text-xs text-gray-500 mt-1 {{ $message->user->id == auth()->id() ? 'text-right' : '' }}">
                                {{ $message->created_at->format('Y-m-d H:i') }}
                            </div>
                        </div>
                    </div>

                    @if($message->user->id == auth()->id())
                        <img src="{{ $message->user->image ?? 'default_icon_url' }}" alt="{{ $message->user->name }}" class="w-10 h-10 rounded-full">
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- メッセージ送信フォーム -->
    <form action="{{ route('communities.chat.store', $community) }}" method="POST" enctype="multipart/form-data" class="px-6 py-4">
        @csrf
        <div class="mb-4">
            <textarea name="message" rows="3" class="w-full rounded-lg border-gray-300 focus:ring focus:ring-gray-300 focus:border-gray-300"></textarea>
        </div>
        <div class="mb-4">
            <input type="file" name="image" class="w-full text-gray-700">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            送信
        </button>
    </form>
</x-app-layout>
