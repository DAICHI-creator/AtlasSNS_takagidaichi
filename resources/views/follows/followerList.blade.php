<x-login-layout>

<div class="max-w-2xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-6">フォロワーリスト</h2>

    @if ($followerUsers->isEmpty())
        <p class="text-center text-gray-500">フォロワーがいません。</p>
    @else
        @foreach ($followerUsers as $user)
            <div class="flex items-center mb-6 p-4 bg-white rounded shadow">
                <!-- ユーザーアイコン -->
                <a href="{{ route('users.show', $user->id) }}" class="w-12 h-12 mr-4">

                <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="ユーザーアイコン" class="w-16 h-16 rounded-full object-cover hover:opacity-80">

                </a>
                <!-- ユーザー情報 -->
                <div>
                    <a href="{{ route('users.show', $user->id) }}" class="text-lg font-bold hover:underline">
                        {{ $user->username }}
                    </a>
                    @if ($user->bio)
                        <p class="text-gray-600 text-sm mt-1">{{ $user->bio }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    @endif

    <!-- フォロワーの投稿一覧 -->
    <h3 class="text-xl font-bold mb-4 mt-8">投稿一覧</h3>

    @if ($followerPosts->isEmpty())
        <p class="text-center text-gray-500">フォロワーの投稿がありません。</p>
    @else
        @foreach ($followerPosts as $post)
            <div class="bg-white p-4 mb-4 rounded shadow flex space-x-4">
                <!-- 投稿者のアイコン -->
                <a href="{{ route('users.show', $post->user->id) }}" class="w-12 h-12">
                    <img src="{{ asset('storage/images/' . $post->user->icon_image) }}" alt="ユーザーアイコン" class="rounded-full w-full h-full object-cover">
                </a>

                <!-- 投稿内容 -->
                <div class="flex-1">
                    <p class="font-bold">{{ $post->user->username }}</p>
                    <p class="mt-1">{{ $post->post_content }}</p>
                    <p class="text-gray-500 text-sm mt-2">{{ $post->created_at->format('Y/m/d H:i') }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>

</x-login-layout>
