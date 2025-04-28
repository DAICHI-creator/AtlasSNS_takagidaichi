<x-login-layout>

<div class="max-w-2xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-6">フォローリスト</h2>

    @if ($followUsers->isEmpty())
        <p class="text-center text-gray-500">フォロー中のユーザーはいません。</p>
    @else
        @foreach ($followUsers as $user)
            <div class="flex items-center mb-6 p-4 bg-white rounded shadow">
                <!-- ユーザーアイコン -->
                <a href="{{ route('users.show', $user->id) }}" class="w-12 h-12 mr-4">
                    <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="アイコン" class="rounded-full w-full h-full object-cover">
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
</div>

</x-login-layout>
