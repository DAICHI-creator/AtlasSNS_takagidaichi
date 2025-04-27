<x-login-layout>

    <h2 class="text-2xl font-bold mb-6 text-center">フォロー/フォロワー 一覧</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($followerUsers as $user)
            <div class="flex items-center p-4 bg-white rounded shadow space-x-4">
                <!-- アイコン -->
                <a href="{{ route('users.show', $user->id) }}">
                    <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="ユーザーアイコン" class="w-12 h-12 rounded-full object-cover">
                </a>

                <!-- ユーザー名 -->
                <a href="{{ route('users.show', $user->id) }}" class="text-lg font-bold hover:underline">
                    {{ $user->username }}
                </a>
            </div>
        @endforeach
    </div>

</x-login-layout>
