<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<x-login-layout>

<div class="mx-auto bg-white p-10 rounded min-h-[100px]">
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="flex">
            <div class="h-12 relative top-[-4px] left-[16px]">
            @php
                // Storage の public ディスクにファイルがあるかチェック
                use Illuminate\Support\Facades\Storage;

                $filename = $user->icon_image
                $storagePath = 'images/' . $filename
            @endphp

            @if (Storage::disk('public')->exists($storagePath))
                {{-- storage/app/public/images/ にあるファイルを優先表示 --}}
                <img src="{{ asset('storage/' . $storagePath) }}" alt="アイコン" class="rounded-full w-full h-full object-cover">
            @else
                {{-- storage になければ public/images/ の初期画像を表示 --}}
                <img src="{{ asset('images/' . $filename) }}" alt="アイコン" class="rounded-full w-full h-full object-cover">
            </div>
            <textarea name="post" rows="2" class="w-3/4 h-24 rounded p-2 resize-none border-none [text-indent:2rem] placeholder:text-gray-300" placeholder="投稿内容を入力してください。"></textarea>
            <button type="submit" class="ml-4 shrink-0 flex w-10 h-10 mt-20">
                <img src="{{ asset('images/post.png') }}" alt="投稿" class="w-10 h-10 hover:opacity-80">
            </button>
        </div>
        @error('post')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </form>
</div>
<div class="bg-gray-200 py-1">
</div>
@foreach ($posts as $post)
    <div class="bg-white" style="border-bottom: 1px solid #888888;">
        <div class="post-item mb-6 p-4 rounded flex space-x-4 items-start relative ml-24">
            <!-- ユーザーアイコン -->
            <div class="w-12 h-12">
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

            <!-- 投稿内容 -->
            <div class="flex-1">
                <!-- ユーザー名 -->
                <p class="font-bold">
                    {{ $post->user->username }}
                </p>

                <!-- 投稿本文 -->
                <p class="mt-1 whitespace-pre-line">
                    {{ $post->post }}
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
                        class="js-modal-open"
                        post="{{ $post->post }}"
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
                    <button type="button" class="trash-btn open-delete-modal" data-post-id="{{ $post->id }}"
                        onmouseenter="this.querySelector('img').src='{{ asset('images/trash-h.png') }}'"
                        onmouseleave="this.querySelector('img').src='{{ asset('images/trash.png') }}'"
                    >
                        <img
                            src="{{ asset('images/trash.png') }}"
                            alt="削除"
                            class="trash-icon w-12 h-12"
                        >
                    </button>
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

            <textarea name="post"
                    class="modal_post">{{ $post->post }}
            </textarea>

            <button  type="submit"
            class="edit-btn"
            onmouseenter="this.querySelector('img').src='{{ asset('images/edit_h.png') }}'"
            onmouseleave="this.querySelector('img').src='{{ asset('images/edit.png') }}'"
            >
            <img
                src="{{ asset('images/edit.png') }}"
                alt="編集"
                class="edit-icon w-12 h-12"
            >
            </button>
        </form>
    </div>
</div>

<!-- 削除確認モーダル -->
<div id="delete-modal-{{ $post->id }}" class="fixed inset-0 hidden z-50">
  <div class="absolute top-0 left-1/2 transform -translate-x-1/2 bg-white w-[300px] p-4" style="border: 1px solid #d3d3d3;">
    <p class="text-sm mb-6">この投稿を削除します。よろしいでしょうか？</p>
    <div class="flex justify-end space-x-4">
      <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-12 py-1 bg-[#7895d7] text-white rounded">OK</button>
      </form>

      <button class="cancel-delete px-4 py-1 bg-gray-200 rounded">キャンセル</button>
    </div>
  </div>
</div>
@endforeach
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    // 編集ボタン(class="js-modal-open")が押されたら発火
    $('.js-modal-open').on('click',function(){
        var post = $(this).attr('post');
        var post_id = $(this).attr('post_id');

        // 自分に対応するモーダルだけ開くように変更！
        const modal = $('#modal-' + post_id);
        modal.fadeIn();

        // そのモーダル内の要素にだけデータをセット
        modal.find('.modal_post').text(post);
        modal.find('.modal_id').val(post_id);

        return false;
    });

    // モーダル閉じるボタン or 背景クリック
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut(); // モーダル非表示
        return false;
    });
});

$(function() {
  // 削除ボタン → モーダル表示
  $('.open-delete-modal').on('click', function() {
    const postId = $(this).data('post-id');
    console.log('クリックされた投稿ID:', postId);
    console.log($('#delete-modal-' + postId).length);
    const modal = $('#delete-modal-' + postId);
    modal.removeClass('hidden').fadeIn();
  });

  // キャンセルボタン → モーダル非表示
  $('.cancel-delete').on('click', function() {
    $(this).closest('.fixed').fadeOut();
  });
});
</script>
</x-login-layout>
