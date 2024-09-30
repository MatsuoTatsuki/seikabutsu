<x-app-layout>
    <x-slot name="header">
        {{ $user->name }} のフォロワー
    </x-slot>

    <ul>
        @foreach($followerUsers as $followerUser)
            <li class="user-item">
                <!-- ユーザーのアイコンを表示 -->
                <img src="{{ $followerUser->image ?? 'default_icon_url' }}" alt="{{ $followerUser->name }}" class="user-icon">

                <!-- ユーザー名、フォロワー数、フォロー中の数を横並びに表示 -->
                <div class="user-details">
                    <!-- ユーザー名 -->
                    <a href="{{ route('profile', $followerUser->id) }}">
                        {{ $followerUser->name }}
                    </a>

                    <!-- フォロワー数 -->
                    <p>フォロワー: {{ $followerUser->followers()->count() }}</p>

                    <!-- フォロー中の数 -->
                    <p>フォロー中: {{ $followerUser->following()->count() }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</x-app-layout>
