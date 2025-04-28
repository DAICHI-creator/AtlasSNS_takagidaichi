<x-login-layout>

<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow text-center">
    <!-- ユーザーアイコン -->
    <div class="w-24 h-24 mx-auto mb-4">
        <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="ユーザーアイコン" class="rounded-full w-full h-full object-cover">
    </div>

    <!-- ユーザー名 -->
    <h2 class="text-2xl font-bold mb-2">{{ $user->username }}</h2>

    <!-- 自己紹介 -->
    <p class="text-gray-600 mb-6">
        {{ $user->bio ?? '自己紹介文はまだありません。' }}
    </p>

    <!-- フォローボタン or フォロー解除ボタン -->
    @if (Auth::id() !== $user->id)  {{-- 自分自身じゃない場合だけボタン表示 --}}
        @if (Auth::user()->isFollowing($user->id))
            <!-- フォロー解除ボタン -->
            <form action="{{ route('unfollow', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded">
                    フォロー解除
                </button>
            </form>
        @else
            <!-- フォローボタン -->
            <form action="{{ route('follow', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded">
                    フォローする
                </button>
            </form>
        @endif
    @endif
</div>
<!-- 投稿一覧 -->
<div class="mt-8">
    <h3 class="text-xl font-bold mb-4">{{ $user->username }} さんの投稿一覧</h3>

    @forelse ($posts as $post)
        <div class="bg-white p-4 mb-4 rounded shadow flex space-x-4">
            <!-- アイコン -->
            <div class="w-12 h-12">
                <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="ユーザーアイコン" class="rounded-full w-full h-full object-cover">
            </div>

            <!-- 投稿内容 -->
            <div class="flex-1">
                <p class="font-bold">{{ $user->username }}</p>
                <p class="mt-1">{{ $post->post_content }}</p>
                <p class="text-gray-500 text-sm mt-2">{{ $post->created_at->format('Y/m/d H:i') }}</p>
            </div>
        </div>
    @empty
        <p class="text-gray-500">まだ投稿はありません。</p>
    @endforelse
</div>

</x-login-layout>
