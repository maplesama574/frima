@extends('site.common1')

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
<main>
    <div class="register">
        <h2>会員登録</h2>
        <div class="register-form">
            <form action="{{route('register')}}" method="POST">
                @csrf
                <div class="register-item">
    <p class="register-item__title">ユーザー名</p>
    <input class="register-input" type="text" name="name" value="{{ old('name') }}">
    @error('name')
        <div class="input-error">{{ $message }}</div>
    @enderror
</div>

<div class="register-item">
    <p class="register-item__title">メールアドレス</p>
    <input class="register-input" type="email" name="email" value="{{ old('email') }}">
    @error('email')
        <div class="input-error">{{ $message }}</div>
    @enderror
</div>

<div class="register-item">
    <p class="register-item__title">パスワード</p>
    <input class="register-input" type="password" name="password">
    @error('password')
        <div class="input-error">{{ $message }}</div>
    @enderror
</div>

<div class="register-item">
    <p class="register-item__title">確認用パスワード</p>
    <input class="register-input" type="password" name="password_confirmation">
    @error('password_confirmation')
        <div class="input-error">{{ $message }}</div>
    @enderror
</div>

               <div class="button">
                    <button class="register-button">登録する</button>
                </div>
            </form>
            <div class="login">
                <a class="login-button" href="{{ route('login') }}">ログインはこちらから</a>
            </div>
        </div>
    </div>
</main>



@endsection