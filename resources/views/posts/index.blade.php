<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<x-login-layout>

<div class="mx-auto bg-white p-10 rounded min-h-[100px]">
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="flex">
            <div class="h-12 mr- relative top-[-4px] left-[16px]">
                <img src="{{ asset('storage/images/' . Auth::user()->icon_image) }}" alt="アイコン" class="rounded-full w-full h-full object-cover">
            </div>
            <textarea name="post_content" rows="2" class="w-3/4 h-24 rounded p-2 resize-none border-none [text-indent:2rem] placeholder:text-gray-300" placeholder="投稿内容を入力してください。"></textarea>
            <button type="submit" class="ml-4 shrink-0 flex w-10 h-10 mt-20">
                <img src="{{ asset('images/post.png') }}" alt="投稿" class="w-10 h-10 hover:opacity-80">
            </button>
        </div>
        @error('post_content')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </form>
</div>
<div class="bg-gray-200 py-2">
</div>
@foreach ($posts as $post)
    <div class="bg-white">
        <div class="post-item mb-6 p-4 rounded flex space-x-4 items-start relative ml-24">
            <!-- ユーザーアイコン -->
            <div class="w-12 h-12">
                <img
                    src="{{ asset('storage/images/' . $post->user->icon_image) }}"
                    alt="ユーザーアイコン"
                    class="rounded-full w-full h-full object-cover"
                >
            </div>

            <!-- 投稿内容 -->
            <div class="flex-1">
                <!-- ユーザー名 -->
                <p class="font-bold">
                    {{ $post->user->username }}
                </p>

                <!-- 投稿本文 -->
                <p class="mt-1 whitespace-pre-line">
                    {{ $post->post_content }}
                </p>

                <!-- 投稿日時 -->
                <p class="absolute top-5 right-7 text-black text-sm">
                    {{ $post->created_at->format('Y/m/d H:i') }}
                </p>
            </div>

            @if ($post->user_id === Auth::id())
                <!-- 編集・削除ボタン -->
                <div class="absolute bottom-2 right-4 flex space-x-2">
                    <!-- 編集ボタン -->
                    <button
                        class="js-modal-open edit-btn"
                        post="{{ $post->post_content }}"
                        post_id="{{ $post->id }}"
                        onmouseenter="this.querySelector('img').src='{{ asset('images/edit_h.png') }}'"
                        onmouseleave="this.querySelector('img').src='{{ asset('images/edit.png') }}'"
                    >
                        <img
                            src="{{ asset('images/edit.png') }}"
                            alt="編集"
                            class="edit-icon w-12 h-12"
                        >
                    </button>

                    <!-- 削除ボタン -->
                    <form
                        method="POST"
                        action="{{ route('posts.destroy', $post->id) }}"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="trash-btn">
                            <img
                                src="{{ asset('images/trash.png') }}"
                                alt="削除"
                                class="trash-icon w-12 h-12"
                            >
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
<!-- モーダルの中身 -->
<div id="modal-{{ $post->id }}" class="modal js-modal">
    <!-- 背景オーバーレイ -->
    <div class="modal__bg js-modal-close"></div>

    <!-- モーダルコンテンツ -->
    <div class="modal__content">
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <textarea name="post_content"
                class="modal_post">{{ $post->post_content }}</textarea>

            <input type="hidden" name="post_id" class="modal_id" value="{{ $post->id }}">

        <!-- 閉じるリンク -->
        <a href="javascript:void(0)" class="js-modal-close">
            ×
        </a>
    </div>
</div>
@endforeach
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    // 編集ボタン(class="js-modal-open")が押されたら発火
    $('.js-modal-open').on('click',function(){
        $('.js-modal').fadeIn(); // モーダル表示
        var post = $(this).attr('post');
        var post_id = $(this).attr('post_id');
        $('.modal_post').text(post);    // 投稿内容をセット
        $('.modal_id').val(post_id);    // 投稿IDをセット
        return false;
    });

    // モーダル閉じるボタン or 背景クリック
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut(); // モーダル非表示
        return false;
    });
});
</script>
</x-login-layout>
