<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<x-login-layout>
<div class="mx-auto bg-white p-10 min-h-[100px]">
    <div>
        <div>
            <a href="{{ route('top') }}">
                <img src="{{ asset('images/atlas.png') }}" alt="Atlasロゴ" class="w-[60px]">
            </a>
        </div>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <!-- ユーザー名 -->
                <div class="">
                    <p>user name</p>
                    <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}" class="">
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- メールアドレス -->
                <div class="">
                    <label class="">mail address</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 新しいパスワード -->
                <div class="">
                    <label class="">password</label>
                    <input type="password" name="password" class="" placeholder="変更しない場合は空白でOK">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 新しいパスワード（確認） -->
                <div class="">
                    <label class="">password confirm</label>
                    <input type="password" name="password_confirmation" class="" placeholder="確認用">
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 自己紹介 -->
                <div class="">
                    <label class="">bio</label>
                    <textarea name="bio" rows="3" class="">{{ old('bio', Auth::user()->bio) }}</textarea>
                    @error('bio')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- アイコン画像 -->
                <div class="">
                    <label class="">icon image</label>
                    <input type="file" name="icon_image" accept="image/*" class="">
                    @error('icon_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit" class="">
                    更新
            </button>
        </form>
    </div>
</div>
</x-login-layout>
