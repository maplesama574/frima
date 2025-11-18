@extends('site.common1')

@section('css')
<link rel="stylesheet" href="{{asset('css/email.css')}}">
@endsection

@section('content')
<main>
    <div class="email">
        <p class="email-complete">登録していただいたメールアドレスに認証メールを送付しました。
            メール認証を完了してください。
        </p>
        <form action="{{route('email')}}" method="POST">
                @csrf
            <button class="verify-button" type="submit">認証はこちらから</button>
        </form>
        <a class="email-button" href="/email/verfity">認証メールを再送する</a>
    </div>

</main>
@endsection