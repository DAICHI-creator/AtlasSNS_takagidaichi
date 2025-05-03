<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <img src="{{ asset('storage/images/' . $post->user->icon_image) }}" alt="ユーザーアイコン" class="rounded-full w-full h-full object-cover">
        </div>

        <!-- 投稿内容 -->
        <div class="flex-1">
            <!-- ユーザー名 -->
            <p class="font-bold">{{ $post->user->username }}</p>
            <!-- 投稿本文 -->
            <p class="mt-1 whitespace-pre-line">{{ $post->post_content }}</p>
            <!-- 投稿日時 -->
            <p class="absolute top-5 right-7 text-black text-sm">{{ $post->created_at->format('Y/m/d H:i') }}</p>
        </div>

        @if ($post->user_id === Auth::id())
        <div class="absolute bottom-2 right-4 flex space-x-2">
            <!-- 編集ボタン -->
            <button onclick="openModal('{{ $post->id }}')" class=" edit-btn">
                <img src="{{ asset('images/edit.png') }}" alt="編集" class="edit-icon w-12 h-12">
            </button>

            <!-- 削除ボタン -->
            <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="trash-btn">
                    <img src="{{ asset('images/trash.png') }}" alt="削除" class="trash-icon w-12 h-12">
                </button>
            </form>
        </div>

            <!-- 編集用モーダル -->
            <div id="modal-{{ $post->id }}" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex justify-end items-center">
                <div class="bg-white p-6 rounded shadow-lg w-[600px] mr-10 relative">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <textarea name="post_content" rows="4" class="w-full p-2 border-b border-gray-400 focus:outline-none resize-none" style="resize: none;">{{ $post->post_content }}</textarea>

                        <button
                            type="button"
                            onclick="closeModal('{{ $post->id }}')"
                            class="absolute right-4 bottom-2 z-10">
                                <img src="{{ asset('images/edit.png') }}" alt="編集完了" class="w-8 h-8 hover:opacity-80">
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endforeach
<script>
    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
    }
</script>
<style>
.edit-btn .edit-icon {
    transition: all 0.3s;
}
.edit-btn:hover .edit-icon {
    content: url('{{ asset('images/edit_h.png') }}');
}

.trash-btn .trash-icon {
    transition: all 0.3s;
}
.trash-btn:hover .trash-icon {
    content: url('{{ asset('images/trash-h.png') }}');
}
</style>
</x-login-layout>
