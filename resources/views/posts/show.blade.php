
<x-app-layout>
    <x-slot name="header">
    
    </x-slot>
    <body>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <div>
            <img src="{{ $post->post_image }}" alt="画像がありません。">
        </div>
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>    
            </div>
        </div>
        <a href="/prefectures/{{ $post->prefecture->id }}">{{ $post->prefecture->name }}</a>
        <h5 class='tag'>
        @foreach($tags as $tag)   
            {{ $tag->tag_name }}
        @endforeach
        </h5>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <h3>コメント</h3>
        <form action="/comments" method="post" >
            @csrf
            <input type="hidden" name='comment[post_id]' value="{{$post->id}}">
            <div class="body">
                <textarea name="comment[comment]" placeholder="コメントを入力してください"></textarea>
            </div>
            <input type="submit" value="store"/>
        </form>

        <div class='comments'>
            @foreach ($post->comments as $comment)
                <div class='comment.content'>
                    <p class='body'>{{ $comment->comment }}</p>
                </div>
            @endforeach
        </div>

    </body>
    </x-app-layout>
