
<x-app-layout>
    <x-slot name="header">
        {{ __('Index') }}
    </x-slot>
    <body>
        <h1>アプリ名</h1>
        <a href="{{ route('create') }}">create</a>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                <h2 class='title'>
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                <div>
                    <img src="{{ $post->post_image }}" alt="画像がありません。">
                </div>
                    <p class='body'>{{ $post->body }}</p>
                </div>
            @endforeach
        </div>
    </body>
</x-app-layout>