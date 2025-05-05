<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>トップページ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div id="head" class="flex items-center justify-between px-6 py-4">
    <div>
        <a href="{{ route('top') }}">
            <img src="{{ asset('images/atlas.png') }}" alt="Atlasロゴ" class="w-[60px]">
        </a>
    </div>

    <div class="flex items-center space-x-6 text-white">
        <div class="flex items-center space-x-1">
            <span>{{ Auth::user()->username }}</span>
            <span>　さん</span>
        </div>

        <div class="relative z-50">
            <!-- アコーディオンボタン -->
            <button id="menuToggle" class="flex items-center justify-center p-2 w-10 h-10">
                <svg id="arrowIcon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 8l6 15 6-15" />
                </svg>
            </button>
        </div>

        <!-- アコーディオンメニュー -->
        <div id="modalMenu" class="fixed inset-0 bg-black bg-opacity-0 hidden z-40">
            <div class="absolute top-[50px] right-0 w-[15.2%] bg-white p-4" style="border: 1px solid #00297e;">
                <ul class="text-black">
                    <li class="mb-2">
                        <a href="{{ route('top') }}" class="block">HOME</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('profile') }}" class="block">プロフィール編集</a>
                    </li>
                    <li>
                        <form method="GET" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left">ログアウト</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12">
                <img src="{{ asset('storage/images/' . Auth::user()->icon_image) }}" alt="ユーザーアイコン" class="rounded-full w-full h-full object-cover">
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.getElementById('menuToggle');
        const menuContent = document.getElementById('modalMenu');
        const arrowIcon = document.getElementById('arrowIcon');

        menuToggle.addEventListener('click', function () {
            menuContent.classList.toggle('hidden'); // メニュー開閉
            arrowIcon.classList.toggle('rotate-180'); // 矢印回転
        });

        modalMenu.addEventListener('click', function (e) {
            // モーダル内のクリックは無視
        if (!e.target.closest('.absolute')) {
            modalMenu.classList.add('hidden');
            arrowIcon.classList.remove('rotate-180');
            }
        });

    });
</script>
