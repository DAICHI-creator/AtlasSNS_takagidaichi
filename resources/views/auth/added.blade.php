<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* 上から下への自然なグラデーション */
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

    <!-- 完了メッセージボックス -->
    <div class="bg-black bg-opacity-20 rounded-xl p-6 shadow-lg w-80 text-center">
        <p class="text-white font-bold mb-2">{{ session('username') }} さん</p>
        <p class="text-white font-bold mb-6">ようこそ！AtlasSNSへ</p>

        <p class="text-white mb-4">ユーザー登録が完了いたしました。</p>
        <p class="text-white mb-6">早速ログインをしてみましょう！</p>

        <div class="flex justify-center">
            <a href="{{ route('login') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded w-2/3 text-center whitespace-nowrap">
                ログイン画面へ
            </a>
        </div>
    </div>

</body>
</html>
