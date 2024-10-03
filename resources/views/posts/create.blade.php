<x-app-layout>
    <div class="container mx-auto p-4 flex">
        <div class="container mx-auto bg-white shadow-lg rounded-lg p-8 max-w-2xl mb-16 mt-16">
            <h1 class="text-2xl font-semibold mb-6 text-center">投稿作成</h1>
            <form action="/posts" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- タイトル -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">タイトル</label>
                    <input type="text" name="post[title]" placeholder="タイトルを入力してください" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                </div>
                
                <!-- 本文 -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">本文</label>
                    <textarea name="post[body]" placeholder="詳しく伝えたいことを書いてください" rows="4" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                
                <!-- 画像 -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">画像</label>
                    <input type="file" name="image" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                </div>
                
                <!-- 住所 -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">住所</label>
                    <input type="text" name="post[address]" placeholder="住所を入力してください" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                </div>
                
                <!-- 都道府県 -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">都道府県</label>
                    <select name="post[prefecture_id]" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- タグ -->
                <div class="mb-6">
                    <h2 class="text-sm font-medium text-gray-700 mb-2">当てはまるものを選んでください</h2>
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center mr-4">
                            <input type="checkbox" name="tags_array[]" value="{{ $tag->id }}" class="form-checkbox text-blue-600">
                            <span class="ml-2 text-gray-700">{{ $tag->tag_name }}</span>
                        </label>
                    @endforeach
                </div>
                
                <!-- 投稿ボタン -->
                <div class="flex justify-center">
                    <input type="submit" value="投稿" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow">
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
