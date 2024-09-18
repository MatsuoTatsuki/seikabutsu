
<x-app-layout>
    <x-slot name="header">
    
    </x-slot>
    <body>
        <h1>Blog Name</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル"/>
            </div>
            <div class="image">
                <input type="file" name="image">
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。"></textarea>
            </div>
            <div class="address">
                <h2>住所</h2>
                <input type="text" name="post[address]"  placeholder="住所を入力してください">
            </div>    
            <div class="prefecture">
                <h2>prefecture</h2>
                <select name="post[prefecture_id]">
                    @foreach($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <h2>ポイント</h2>
                @foreach($tags as $tag)

                    <label>
                        <input type="checkbox" value="{{ $tag->id }}" name="tags_array[]">
                            {{$tag->tag_name}}
                        </input>
                    </label>
                    
                @endforeach         
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
