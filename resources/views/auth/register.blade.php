<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規ユーザー登録</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(
                180deg,
                rgba(2, 112, 209, 1) 0%,
                rgba(73, 146, 153, 1) 60%,
                rgba(130, 171, 130, 1) 67%,
                rgba(168, 196, 88, 1) 73%,
                rgba(246, 223, 57, 1) 100%
            );
            min-height: 100vh;
        }
    </style>
</head>
<body class="flex items-center justify-center flex-col">

    <!-- ロゴ部分 -->
    <div class="text-center mb-4">
        <img src="{{ asset('images/atlas.png') }}" alt="Atlasロゴ" class="mx-auto w-32 mb-2">
        <p class="text-3xl text-white">Social Network Service</p>
    </div>

    <!-- 登録フォーム -->
    @if ($errors->any())
    <div class="text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="bg-black bg-opacity-20 rounded-xl p-6 shadow-lg w-80">
        <h2 class="text-white text-xl mb-6 text-center">新規ユーザー登録</h2>

        <form method="POST" action="{{ route('user.register') }}">
            @csrf

            <div class="mb-4">
                <label class="text-white block mb-2">user name</label>
                <input type="text" name="username" required class="w-full p-2 rounded border border-gray-300 focus:outline-none focus:border-gray-400">
            </div>

            <div class="mb-4">
                <label class="text-white block mb-2">mail address</label>
                <input type="email" name="email" required class="w-full p-2 rounded border border-gray-300 focus:outline-none focus:border-gray-400">
            </div>

            <div class="mb-4">
                <label class="text-white block mb-2">password</label>
                <input type="password" name="password" required class="w-full p-2 rounded border border-gray-300 focus:outline-none focus:border-gray-400">
            </div>

            <div class="mb-6">
                <label class="text-white block mb-2">password confirm</label>
                <input type="password" name="password_confirmation" required class="w-full p-2 rounded border border-gray-300 focus:outline-none focus:border-gray-400">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded w-1/2">
                    REGISTER
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-white no-underline hover:underline">
                ログイン画面に戻る
            </a>
        </div>
    </div>

</body>
</html>
