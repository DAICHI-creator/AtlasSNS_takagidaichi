<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<x-login-layout>

<div class="mx-auto bg-white p-10 rounded min-h-[100px] flex items-center">
<!-- 検索フォーム -->
<form method="GET" action="{{ route('search') }}" class="flex items-center">
    <input type="text" name="keyword" placeholder="ユーザー名" value="{{ request('keyword') }}" class="border rounded p-2 w-64">
    <button type="submit" class="ml-2">
        <img src="{{ asset('images/search.png') }}" alt="検索" class="w-10 h-10">
    </button>
</form>

<!-- 検索ワード表示 -->
@if (request('keyword'))
    <p class="ml-[300px]">検索ワード：「{{ request('keyword') }}」</p>
@endif
</div>

<div class="bg-gray-200 py-1 mb-6">
</div>

<div class="space-y-4 max-w-[500px] mx-auto">
    @foreach ($users as $user)
        <div class="flex items-center justify-between p-4 bg-white rounded">
            <!-- アイコンとユーザー名 -->
            <div class="flex items-center">
                <a href="{{ route('users.show', $user->id) }}">
                    <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="アイコン" class="w-12 h-12 rounded-full object-cover mr-4">
                </a>
                <p>{{ $user->username }}</p>
            </div>

            <!-- フォロー／フォロー解除ボタン -->
            <div>
                @if (Auth::user()->isFollowing($user->id))
                    <!-- フォローしてる場合：解除ボタン -->
                    <form method="POST" action="{{ route('unfollow', $user->id) }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                            フォロー解除
                        </button>
                    </form>
                @else
                    <!-- フォローしてない場合：フォローボタン -->
                    <form method="POST" action="{{ route('follow', $user->id) }}">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                            フォローする
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
</x-login-layout>
