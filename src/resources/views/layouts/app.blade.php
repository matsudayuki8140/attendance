<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <h1 class="header-title">Atte</h1>
            @if(Auth::check())
            <nav class="header-nav">
                <ul class="nav-list">
                    <li><a href="/" class="nav-link">ホーム</a></li>
                    <li><a href="/attendance" class="nav-link">日付一覧</a></li>
                    <li><a href="/users" class="nav-link">ユーザー一覧</a></li>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button class="nav-link__logout">ログアウト</button>
                        </form>
                    </li>
                </ul>
            </nav>
            @endif
        </div>
    </header>

    <main class="content">
        <div class="content-inner">
            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="footer-inner">
            <small class="copy-right">Atte,inc.</small>
        </div>
    </footer>
</body>
</html>