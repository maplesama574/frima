<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{asset('css/app1.css')}}">
    @yield('css')
</head>
<body>
    <header>
        <div class="header-title">
            <a class="header-logo" href="{{ route('login') }}">
                <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="ロゴ" style="height: 35px; width: auto;">
            </a>
        </div>
    </header>

@yield('content')
    
</body>
</html>