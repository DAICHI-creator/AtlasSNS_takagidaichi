        <div id="head">
            <h1><a href="{{ route('top') }}"><img src="{{ asset('images/atlas.png') }}" alt="Atlasロゴ"></a></h1>
            <div id="">
                <div id="">
                    <p>{{ session('username') }}さん</p>
                </div>
                <!-- アコーディオンボタン -->
                <!-- アコーディオン中身 -->
                <ul id="menuContent" class="mt-2 hidden bg-white rounded shadow p-2 text-black">
                    <li class="mb-2"><a href="{{ route('top') }}" class="block hover:underline">HOME</a></li>
                    <li class="mb-2"><a href="">プロフィール編集</a></li>
                    <form method="GET" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">ログアウト</button>
                    </form>
                </ul>
            </div>
        </div>
