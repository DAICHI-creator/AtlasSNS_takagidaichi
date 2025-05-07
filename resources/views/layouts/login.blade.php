<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Scripts -->
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
      @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
  <header>
    @include('layouts.navigation')
  </header>
  <!-- Page Content -->
  <div id="row" class="flex w-screen min-h-screen bg-white">
    <div id="container">
      {{ $slot }}
    </div>
    <div id="side-bar">
      <div id="confirm" class="bg-white rounded border p-4">

        <p class="mb-4 text-base">{{ Auth::user()->username }}さんの</p>

        <div class="mb-6">
          <p class="text-base mb-1">フォロー数　　{{ Auth::user()->follows()->count() }}人</p>
          <p class="mt-2 flex justify-end pr-2">
            <a href="{{ route('follow-list') }}"
           class="bg-[#0756cf] text-white text-sm px-4 py-2 rounded w-[90px] text-center">フォローリスト</a>
          </p>
        </div>

        <div class="mb-10">
          <p class="text-base mb-1">フォロワー数　　{{ Auth::user()->followers()->count() }}人</p>
          <p class="mt-2 flex justify-end pr-2">
            <a href="{{ route('follower-list') }}"
           class="bg-[#0756cf] text-white text-sm px-4 py-2 rounded w-[90px] text-center">フォロワーリスト</a>
          </p>
        </div>
      </div>

        <div class="w-full h-[2px] bg-gray-400 mb-6"></div>

        <div class="flex justify-center">
          <a href="{{ route('search') }}"
         class="bg-[#0756cf] text-white text-sm px-6 py-2 rounded w-[100px] text-center">ユーザー検索</a>
        </div>
  </div>
</div>
  <footer></footer>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="JavaScriptファイルのURL"></script>
  <script src="JavaScriptファイルのURL"></script>
</body>

</html>
