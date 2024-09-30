<x-app-layout>
    <x-slot name="header">
        {{ $user->name }} がフォロー中のユーザー
    </x-slot>

    <ul>
        @foreach($followingUsers as $followingUser)
            <li class="user-item">
                <!-- ユーザーのアイコンを表示 -->
                <img src="{{ $followingUser->image ?? 'default_icon_url' }}" alt="{{ $followingUser->name }}" class="user-icon">

                <!-- ユーザー名、フォロワー数、フォロー中の数を横並びに表示 -->
                <div class="user-details">
                    <!-- ユーザー名 -->
                    <a href="{{ route('profile', $followingUser->id) }}">
                        {{ $followingUser->name }}
                    </a>

                    <!-- フォロワー数 -->
                    <p>フォロワー: {{ $followingUser->followers()->count() }}</p>

                    <!-- フォロー中の数 -->
                    <p>フォロー中: {{ $followingUser->following()->count() }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</x-app-layout>
