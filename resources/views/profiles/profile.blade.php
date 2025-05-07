<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<x-login-layout>

    <div class="bg-white rounded p-8 shadow-md max-w-md mx-auto">
        <h2 class="text-2xl font-bold mb-6">プロフィール編集</h2>

        @if (session('message'))
            <div class="mb-4 p-2 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf

            <!-- ユーザー名 -->
            <div class="mb-4">
                <label class="block mb-2">ユーザー名</label>
                <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}" class="w-full p-2 border rounded">
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- メールアドレス -->
            <div class="mb-4">
                <label class="block mb-2">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full p-2 border rounded">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- 新しいパスワード -->
            <div class="mb-4">
                <label class="block mb-2">新しいパスワード</label>
                <input type="password" name="password" class="w-full p-2 border rounded" placeholder="変更しない場合は空白でOK">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- 新しいパスワード（確認） -->
            <div class="mb-4">
                <label class="block mb-2">新しいパスワード（確認）</label>
                <input type="password" name="password_confirmation" class="w-full p-2 border rounded" placeholder="確認用">
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- 自己紹介 -->
            <div class="mb-4">
                <label class="block mb-2">自己紹介</label>
                <textarea name="bio" rows="3" class="w-full p-2 border rounded">{{ old('bio', Auth::user()->bio) }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- アイコン画像 -->
            <div class="mb-6">
                <label class="block mb-2">アイコン画像</label>
                <input type="file" name="icon_image" accept="image/*" class="w-full">
                @error('icon_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                更新する
            </button>
        </form>
    </div>

</x-login-layout>
