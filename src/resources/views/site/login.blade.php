@extends('site.common1')

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')
<main>
    <div class="login">
        <h2>ログイン</h2>
        <div class="login-form">
<form method="POST" action="{{ route('login') }}">
    @csrf

    @if($errors->any())
        <div class="input-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="login-item">
        <p class="login-item__title">メールアドレス</p>
        <input class="login-input" type="email" name="email" required>
    </div>

    <div class="login-item">
        <p class="login-item__title">パスワード</p>
        <input class="login-input" type="password" name="password" required>
    </div>

    <div class="button">
        <button type="submit" class="login-button">ログインする</button>
    </div>
</form>

            <div class="login">
                <a class="register-button" href="/register">会員登録はこちらから</a>
            </div>
        </div>
    </div>
</main>

@endsection