<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('アイコンの変更') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("好きなアイコンにして") }}
        </p>
    </header>

    <form action="{{ route('profile_image.update') }}" method="POST" enctype="multipart/form-data"　class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <label for="image">プロフィール画像をアップロード</label>
                <input type="file" name="image" id="image">
            
                <button type="submit">保存</button>
    </form>

</section>
