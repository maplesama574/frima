@extends('site.common1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/email.css') }}">
@endsection

@section('content')
<main>
    <form action="{{ route('verification.send') }}" method="POST">
    @csrf
    <div class="email">
        <p class="email-complete">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
        </p>

        <a class="verify-form" href="http://localhost:8025/" target="_blank" rel="noopener noreferrer">
    認証はこちらから
        </a>


        <!-- 認証メール再送 -->
            <button class="verify-button" type="submit">認証メールを再送する</button>

        @if (session('message'))
            <div class="resend-message">
                {{ session('message') }}
            </div>
        @endif
    </div>
    </form>
</main>
@endsection
