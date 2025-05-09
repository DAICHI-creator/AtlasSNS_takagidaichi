<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<x-login-layout>

<div class="mx-auto bg-white p-10 ml-10 min-h-[100px] flex">
    <h2 class="text-2xl mt-2 font-bold">Follow List</h2>
    <div class="flex ml-10">
        @if ($followedUsers->isEmpty())
            <p class="text-center text-gray-500">フォローしていません。</p>
        @else
        @foreach ($followedUsers as $user)
            <!-- ユーザーアイコン -->
            <a href="{{ route('users.show', $user->id) }}" class="block mr-3 w-12 h-12">
                <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="ユーザーアイコン" class="w-12 h-12 rounded-full object-cover hover:opacity-80">
            </a>
        @endforeach
        @endif
    </div>
</div>
<div class="bg-gray-200 py-1"></div>
<div>
    <!-- フォロワーの投稿一覧 -->
    @if ($followedPosts->isEmpty())
        <p class="text-center text-gray-500">フォロワーの投稿がありません。</p>
    @else
    @foreach ($followedPosts as $post)
        <div class="bg-white" style="border-bottom: 1px solid #888888;">
            <div class="post-item mb-6 p-4 rounded flex space-x-4 items-start relative ml-24">
                <!-- ユーザーアイコン -->
                <div class="w-12 h-12">
                    <a href="{{ route('users.show', $post->user->id) }}">
                        <img
                            src="{{ asset('storage/images/' . $post->user->icon_image) }}"
                            alt="ユーザーアイコン"
                            class="rounded-full w-full h-full object-cover">
                    </a>
                </div>

                <!-- 投稿内容 -->
                <div class="flex-1">
                    <!-- ユーザー名 -->
                    <p class="font-bold">
                        {{ $post->user->username }}
                    </p>

                    <!-- 投稿本文 -->
                    <p class="mt-1 whitespace-pre-line">
                        {{ $post->post }}
                    </p>

                    <!-- 投稿日時 -->
                    <p class="absolute top-5 right-7 text-black text-sm">
                        {{ $post->created_at->format('Y/m/d H:i') }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
    @endif
</div>

</x-login-layout>
