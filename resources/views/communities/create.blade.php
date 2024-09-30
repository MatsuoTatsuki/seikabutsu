<x-app-layout>
    <x-slot name="header">
        コミュニティを作成
    </x-slot>

    <form action="{{ route('communities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">コミュニティ名:</label>
        <input type="text" name="name" id="name" required>

        <label for="description">コミュニティの説明:</label>
        <textarea name="description" id="description"></textarea>

        <label for="icon">コミュニティのアイコン:</label>
        <input type="file" name="icon" id="icon">

        <button type="submit">作成</button>
    </form>
</x-app-layout>
