@extends('site.common1')

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')
<main>
    <div class="login">
        <h2>ログイン</h2>
        <div class="login-form">
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="login-item">
                    <p class="login-item__title">メールアドレス</p>
                    <input class="login-input" type="email" name="email">
                </div>
                <div class="login-item">
                    <p class="login-item__title">パスワード</p>
                    <input class="login-input" type="password" name="password">
                </div>
                <div class="button">
                    <button class="login-button">ログインする</button>
                </div>
            </form>
            <div class="login">
                <a class="register-button" href="/register">会員登録はこちらから</a>
            </div>
        </div>
    </div>
</main>

@endsection