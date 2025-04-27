<div id="head" class="relative">
    <h1>
        <a href="{{ route('top') }}">
            <img src="{{ asset('images/atlas.png') }}" alt="Atlasロゴ">
        </a>
    </h1>

    <div class="mt-4">
        <div>
            <p>{{ Auth::user()->username }}さん</p>  <!-- ここも修正済みOK！ -->
        </div>

        <!-- アコーディオンボタン -->
        <button id="menuToggle" class="flex items-center justify-between w-full bg-blue-500 text-white p-2 rounded">
            メニュー
            <svg id="arrowIcon" class="w-4 h-4 ml-2 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- アコーディオンメニュー -->
        <ul id="menuContent" class="mt-2 hidden bg-white rounded shadow p-2 text-black">
            <li class="mb-2">
                <a href="{{ route('top') }}" class="block hover:underline">HOME</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('profile') }}" class="block hover:underline">プロフィール編集</a>
            </li>
            <li>
                <form method="GET" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left hover:underline">ログアウト</button>
                </form>
            </li>
        </ul>
        <div class="mt-4 flex items-center space-x-4">
            <div class="w-12 h-12">
                <img src="{{ asset('storage/images/' . Auth::user()->icon_image) }}" alt="ユーザーアイコン" class="rounded-full w-full h-full object-cover">
            </div>
            <div>
                <p class="text-white">{{ Auth::user()->username }}さん</p>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.getElementById('menuToggle');
        const menuContent = document.getElementById('menuContent');
        const arrowIcon = document.getElementById('arrowIcon');

        menuToggle.addEventListener('click', function () {
            menuContent.classList.toggle('hidden'); // メニュー開閉
            arrowIcon.classList.toggle('rotate-180'); // 矢印回転
        });
    });
</script>
