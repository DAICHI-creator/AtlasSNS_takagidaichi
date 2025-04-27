<x-login-layout>

@foreach ($posts as $post)
    <div class="post-item mb-6 p-4 bg-white rounded shadow flex space-x-4 items-start relative">
        <!-- ユーザーアイコン -->
        <div class="w-12 h-12">
            <img src="{{ asset('storage/images/' . $post->user->icon_image) }}" alt="ユーザーアイコン" class="rounded-full w-full h-full object-cover">
        </div>

        <!-- 投稿内容 -->
        <div class="flex-1">
            <!-- ユーザー名 -->
            <p class="font-bold">{{ $post->user->username }}</p>
            <!-- 投稿本文 -->
            <p class="mt-1">{{ $post->post_content }}</p>
            <!-- 投稿日時 -->
            <p class="text-gray-500 text-sm mt-2">{{ $post->created_at->format('Y/m/d H:i') }}</p>
        </div>

        @if ($post->user_id === Auth::id())
            <!-- 編集ボタン -->
            <button onclick="openModal('{{ $post->id }}')" class="absolute top-2 right-14 edit-btn">
                <img src="{{ asset('images/edit.png') }}" alt="編集" class="edit-icon w-6 h-6">
            </button>

            <!-- 削除ボタン -->
            <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="absolute top-2 right-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="trash-btn">
                    <img src="{{ asset('images/trash.png') }}" alt="削除" class="trash-icon w-6 h-6">
                </button>
            </form>

            <!-- 編集用モーダル -->
            <div id="modal-{{ $post->id }}" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                <div class="bg-white p-6 rounded shadow-lg w-96">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf

                        <textarea name="post_content" rows="4" class="w-full p-2 border rounded mb-4">{{ $post->post_content }}</textarea>

                        <div class="flex justify-end">
                            <button type="button" onclick="closeModal('{{ $post->id }}')" class="mr-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">キャンセル</button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">更新</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
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
    content: url('{{ asset('images/trash_h.png') }}');
}
</style>
</x-login-layout>
