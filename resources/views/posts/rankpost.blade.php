<x-app-layout>
    <x-slot name="header">
        
    </x-slot>
    <body>
        
        <div class='rankpost'>
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