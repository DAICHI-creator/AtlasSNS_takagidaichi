<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center flex-col custom-bg">

    <div class="text-center mb-8">
        <h1 class="text-5xl font-bold text-white">At<span class="text-blue-300 italic">las</span></h1>
        <p class="text-2xl text-white">Social Network Service</p>
    </div>

    <div class="bg-blue-600 bg-opacity-80 rounded-xl p-8 shadow-lg w-96">
        <h2 class="text-white text-xl mb-6">AtlasSNSへようこそ</h2>

        <!-- メールアドレスとパスワードの入力フォーム -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="text-white block mb-2">メールアドレス</label>
                <input type="email" name="email" required class="w-full p-2 rounded border-2 border-lime-300 focus:outline-none focus:border-lime-500">
            </div>

            <div class="mb-6">
                <label class="text-white block mb-2">パスワード</label>
                <input type="password" name="password" required class="w-full p-2 rounded border-2 border-lime-300 focus:outline-none focus:border-lime-500">
            </div>

            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded w-full">
                ログイン
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('register') }}" class="text-white underline">新規ユーザーの方はこちら</a>
        </div>
    </div>

</body>
</html>
