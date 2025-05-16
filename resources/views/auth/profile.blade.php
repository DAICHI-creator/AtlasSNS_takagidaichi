<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<x-login-layout>
<div class="flex justify-center bg-white p-10 min-h-[100px] mt-20 max-w-5xl mx-auto">
    <!-- アイコン -->
    <div class="w-12 h-12 mr-20 flex-shrink-0">
        @php
            // Storage の public ディスクにファイルがあるかチェック
            use Illuminate\Support\Facades\Storage;

            $filename = $user->icon_image;
            $storagePath = 'images/' . $filename;
        @endphp

        @if (Storage::disk('public')->exists($storagePath))
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

    <!-- フォーム -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="w-full max-w-[600px] mt-2">
        @csrf

        <!-- ユーザー名 -->
        <div class="mb-20">
        <div class="flex items-center">
            <div class="w-56 mr-4">
                <label class="block text-left whitespace-nowrap font-semibold">ユーザー名</label>
            </div>
            <div class="flex justify-end w-full">
                <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}"
                       class="w-[300px] p-2 border bg-gray-100">
            </div>
        </div>
        @error('username')
            <p class="text-red-500 text-sm mt-1 ml-[224px]">{{ $message }}</p>
        @enderror
        </div>

        <!-- メールアドレス -->
        <div class="mb-20">
        <div class="flex items-center">
            <div class="w-56 mr-4">
                <label class="block text-left whitespace-nowrap font-semibold">メールアドレス</label>
            </div>
            <div class="flex justify-end w-full">
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                       class="w-[300px] p-2 border bg-gray-100">
            </div>
        </div>
        @error('email')
            <p class="text-red-500 text-sm mt-1 ml-[224px]">{{ $message }}</p>
        @enderror
        </div>

        <!-- パスワード -->
        <div class="mb-20">
        <div class="flex items-center">
            <div class="w-56 mr-4">
                <label class="block text-left whitespace-nowrap font-semibold">パスワード</label>
            </div>
            <div class="flex justify-end w-full">
                <input type="password" name="password"  autocomplete="new-password" placeholder="変更しない場合は空白でOK"
                       class="w-[300px] p-2 border bg-gray-100">
            </div>
        </div>
        @error('password')
            <p class="text-red-500 text-sm mt-1 ml-[224px]">{{ $message }}</p>
        @enderror
        </div>

        <!-- パスワード確認 -->
        <div class="mb-20">
        <div class="flex items-center">
            <div class="w-56 mr-4">
                <label class="block text-left whitespace-nowrap font-semibold">パスワード確認</label>
            </div>
            <div class="flex justify-end w-full">
                <input type="password" name="password_confirmation" placeholder="確認用"
                       class="w-[300px] p-2 border bg-gray-100">
            </div>
        </div>
        @error('password_confirmation')
            <p class="text-red-500 text-sm mt-1 ml-[224px]">{{ $message }}</p>
        @enderror
        </div>


        <!-- 自己紹介 -->
        <div class="mb-20">
        <div class="flex items-center">
            <div class="w-56 mr-4">
                <label class="block text-left whitespace-nowrap font-semibold">自己紹介文</label>
            </div>
            <div class="flex justify-end w-full">
                <textarea name="bio" rows="1" class="w-[300px] p-2 border resize-none bg-gray-100">{{ old('bio', Auth::user()->bio) }}</textarea>
            </div>
        </div>
        @error('bio')
            <p class="text-red-500 text-sm mt-1 ml-[224px]">{{ $message }}</p>
        @enderror
        </div>


        <!-- アイコン画像 -->
        <div class="mb-20">
        <div class="flex">
            <div class="w-56 mr-4">
                <label class="block text-left whitespace-nowrap font-semibold">アイコン画像</label>
            </div>
            <div class="flex justify-end w-full">
                <div class="w-[300px] h-[100px] bg-gray-100 flex items-center justify-center border border-gray-500 border-solid">
                    <label for="icon_image" id="custom-file-label"
                        class="bg-white px-6 py-2 text-gray-300 cursor-pointer hover:bg-gray-50">
                        ファイルを選択
                    </label>
                    <input type="file" id="icon_image" name="icon_image" accept="image/*" class="hidden">
                </div>
            </div>
        </div>
        @error('icon_image')
            <p class="text-red-500 text-sm mt-1 ml-[224px]">{{ $message }}</p>
        @enderror
        </div>


        <!-- 更新ボタン -->
        <div class="pt-10 text-center mr-20">
            <button type="submit" class="bg-red-500 text-white py-2 px-20 rounded hover:bg-red-600">
                更新
            </button>
        </div>
    </form>
</div>
<script>
    const fileInput = document.getElementById('icon_image');
    const fileLabel = document.getElementById('custom-file-label');

    fileInput.addEventListener('change', function () {
        if (fileInput.files.length > 0) {
            fileLabel.textContent = fileInput.files[0].name;
            fileLabel.classList.remove('text-gray-300');
            fileLabel.classList.add('text-gray-700');
        } else {
            fileLabel.textContent = 'ファイルを選択';
            fileLabel.classList.remove('text-gray-700');
            fileLabel.classList.add('text-gray-300');
        }
    });
</script>
</x-login-layout>
