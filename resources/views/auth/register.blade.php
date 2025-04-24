<x-logout-layout>
    <!-- 適切なURLを入力してください -->
{!! Form::open(['route' => 'register']) !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('username','ユーザー名') }}
{{ Form::text('username',old('username'),['class' => 'input']) }}
@error('username')
  <div class="text-red-600">{{ $message }}</div>
@enderror

{{ Form::label('email','メールアドレス') }}
{{ Form::email('email',old('email'),['class' => 'input']) }}
@error('email')
  <div class="text-red-600">{{ $message }}</div>
@enderror

{{ Form::label('password','パスワード') }}
{{ Form::password('password',['class' => 'input']) }}
@error('password')
  <div class="text-red-600">{{ $message }}</div>
@enderror

{{ Form::label('password_confirmation','パスワード確認') }}
{{ Form::password('password_confirmation',['class' => 'input']) }}
@error('password_confirmation')
  <div class="text-red-600">{{ $message }}</div>
@enderror

{{ Form::submit('登録') }}

<p><a href="{{ route('login') }}">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


</x-logout-layout>
