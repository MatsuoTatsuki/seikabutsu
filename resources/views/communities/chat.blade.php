<x-app-layout>
    <x-slot name="header">
        {{ $community->name }} のチャット
    </x-slot>

    <div class="chat-messages">
        @foreach($messages as $message)
            <div>
                <strong>{{ $message->user->name }}:</strong>
                @if($message->message)
                    <p>{{ $message->message }}</p>
                @endif
                @if($message->image)
                    <img src="{{ $message->image }}" alt="画像" width="100">
                @endif
            </div>
        @endforeach
    </div>

    <form action="{{ route('communities.chat.store', $community) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="message" rows="3"></textarea>
        <input type="file" name="image">
        <button type="submit">送信</button>
    </form>
</x-app-layout>
