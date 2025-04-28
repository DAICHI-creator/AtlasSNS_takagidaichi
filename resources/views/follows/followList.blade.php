<x-login-layout>

<div class="p-4">
    <h2 class="text-2xl font-bold mb-6">フォローリスト</h2>

    <!-- フォローしているユーザーアイコン一覧 -->
    <div class="flex flex-wrap gap-4 mb-8">
        @foreach ($followedUsers as $user)
            <a href="{{ route('users.show', $user->id) }}">
                <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="ユーザーアイコン" class="w-16 h-16 rounded-full object-cover hover:opacity-80">
            </a>
        @endforeach
    </div>

    <!-- フォローしているユーザーの投稿一覧 -->
    <h3 class="text-xl font-bold mb-4">投稿一覧</h3>

    @forelse ($followedPosts as $post)
        <div class="bg-white p-4 mb-4 rounded shadow flex space-x-4">
            <!-- ユーザーアイコン -->
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
    @empty
        <p class="text-gray-500">投稿がありません。</p>
    @endforelse
</div>

</x-login-layout>
