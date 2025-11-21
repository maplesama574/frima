@extends('site.common1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/email.css') }}">
@endsection

@section('content')
<main>
    <div class="email">
        <p class="email-complete">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール内のリンクをクリックして認証を完了してください。
        </p>

        @if (session('message'))
            <div class="resend-message">
                {{ session('message') }}
            </div>
        @endif

        <!-- 認証メール再送 -->
        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button class="verify-button" type="submit">認証メールを再送する</button>
        </form>
    </div>
</main>
@endsection
