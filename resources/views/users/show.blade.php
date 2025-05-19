<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<x-login-layout>

<div class="bg-white rounded min-h-[100px] py-6 px-12">
    <div class="flex ml-10 mt-7">
        <div class="flex">
                @php
                    $filename = $user->icon_image;
                    $storagePath  = 'images/' . $filename;
                @endphp

                @if (\Storage::disk('public')->exists($storagePath))
                    {{-- storage/app/public/images/ にあるファイルを優先表示 --}}
                    <img src="{{ asset('storage/' . $storagePath) }}" alt="アイコン" class="rounded-full w-12 h-12 object-cover">
                @else
                    {{-- storage になければ public/images/ の初期画像を表示 --}}
                    <img src="{{ asset('images/' . $filename) }}" alt="アイコン" class="rounded-full w-12 h-12 object-cover">
                @endif
            <div class="ml-10">
                <p class="text-2xl mb-2">name</p>
                <br>
                <p class="text-2xl mb-2">bio</p>
            </div>
        </div>
        <div class="ml-40">
            <p class="text-2xl mb-2">{{ $user->username }}</p>
            <br>
            <p class="text-2xl mb-2">{{ $user->bio }}</p>
        </div>
    </div>

    <!-- フォローボタン or フォロー解除ボタン -->
    @if (Auth::id() !== $user->id)  {{-- 自分自身じゃない場合だけボタン表示 --}}
    <div class="flex justify-end">
        @if (Auth::user()->isFollowing($user->id))
            <!-- フォロー解除ボタン -->
            <form action="{{ route('unfollow', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded">
                    フォロー解除
                </button>
            </form>
        @else
            <!-- フォローボタン -->
            <form action="{{ route('follow', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded">
                    フォローする
                </button>
            </form>
        @endif
    </div>
    @endif
</div>
<div class="bg-gray-200 py-1"></div>
<!-- 投稿一覧 -->
@forelse ($posts as $post)
    <div class="bg-white" style="border-bottom: 1px solid #888888;">
        <div class="post-item mb-4 p-4 rounded flex space-x-4 items-start relative ml-24">
            <!-- アイコン -->
            <div class="w-12 h-12">
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
            </div>

            <!-- 投稿内容 -->
            <div class="flex-1">
                <p class="font-bold">{{ $user->username }}</p>
                <p class="mt-1 whitespace-pre-line">{{ $post->post_content }}</p>
                <p class="absolute top-5 right-7 text-black text-sm">{{ $post->created_at->format('Y/m/d H:i') }}</p>
            </div>
        </div>
    </div>
@empty
    <p class="text-gray-500">まだ投稿はありません。</p>
@endforelse

</x-login-layout>
