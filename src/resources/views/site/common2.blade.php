<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{asset('css/app2.css')}}">
    @yield('css')
</head>
<body>
    <header>
        <div class="header-title">
    <div class="logo">
        <a href="{{ route('login') }}">
            <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="ロゴ">
        </a>
    </div>

    <div class="search-form">
        <form action="{{ route('first.search') }}" method="GET">
            @csrf
            <input type="text" name="keyword" placeholder="なにをお探しですか？">
        </form>
    </div>

    <div class="search-nav">
        <a class="nav" href="/login">ログアウト</a>
        <a class="nav" href="/mypage">マイページ</a>
        <a class="nav-sell" href="/sell">出品</a>
    </div>
</div>

    </header>

@yield('content')
</body>
</html>