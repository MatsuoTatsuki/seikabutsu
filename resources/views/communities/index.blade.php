<x-app-layout>
    <x-slot name="header">
        コミュニティ一覧
    </x-slot>

    <a href="{{ route('communities.create') }}">コミュニティを作成する</a>

    <ul>
        @foreach($communities as $community)
            <li>
                <img src="{{ $community->icon }}" alt="{{ $community->name }}" width="50" height="50" style="border-radius: 50%;">
                <a href="{{ route('communities.chat', $community) }}">
                    {{ $community->name }}
                </a>
            </li>
        @endforeach
    </ul>
</x-app-layout>
