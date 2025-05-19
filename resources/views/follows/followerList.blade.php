<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<x-login-layout>

<div class="mx-auto bg-white p-10 ml-10 min-h-[100px] flex">
    <h2 class="text-2xl mt-2 font-bold">Follower List</h2>
    <div class="flex ml-10">
        @if ($followerUsers->isEmpty())
            <p class="text-center text-gray-500">フォロワーがいません。</p>
        @else
        @foreach ($followerUsers as $user)
            <!-- ユーザーアイコン -->
            <a href="{{ route('users.show', $user->id) }}" class="block mr-3 w-12 h-12">
                @php
                    $filename = $user->icon_image;
                    $storagePath  = 'images/' . $filename;
                @endphp

                @if (\Storage::disk('public')->exists($storagePath))
                    {{-- storage/app/public/images/ にあるファイルを優先表示 --}}
                    <img src="{{ asset('storage/' . $storagePath) }}" alt="アイコン" class="rounded-full w-full h-full object-cover">
                @else
                    {{-- storage になければ public/images/ の初期画像を表示 --}}
                    <img src="{{ asset('images/' . $filename) }}" alt="アイコン" class="rounded-full w-full h-full object-cover">
                @endif
            </a>
        @endforeach
        @endif
    </div>
</div>
<div class="bg-gray-200 py-1"></div>
<div>
    <!-- フォロワーの投稿一覧 -->
    @if ($followerPosts->isEmpty())
        <p class="text-center text-gray-500">フォロワーの投稿がありません。</p>
    @else
    @foreach ($followerPosts as $post)
        <div class="bg-white" style="border-bottom: 1px solid #888888;">
            <div class="post-item mb-6 p-4 rounded flex space-x-4 items-start relative ml-24">
                <!-- ユーザーアイコン -->
                <div class="w-12 h-12">
                    <a href="{{ route('users.show', $post->user->id) }}">
                        @php
                            $filename = $post->user->icon_image;
                            $storagePath = 'images/' . $filename;
                        @endphp

                        @if (\Storage::disk('public')->exists($storagePath))
                            {{-- storage/app/public/images/ にあるファイルを優先表示 --}}
                            <img
                                src="{{ asset('storage/' . $storagePath) }}"
                                alt="アイコン"
                                class="rounded-full w-full h-full object-cover"
                            >
                        @else
                            {{-- storage になければ public/images/ の初期画像を表示 --}}
                            <img
                                src="{{ asset('images/' . $filename) }}"
                                alt="アイコン"
                                class="rounded-full w-full h-full object-cover"
                            >
                        @endif
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
