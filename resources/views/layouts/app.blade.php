<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>バンチカンリ@yield('title')</title>

    {{-- Bootstrap CSS を先に読み込む --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500&display=swap" rel="stylesheet">

    {{-- アプリケーションのCSS/JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
</head>
<body>
    <div class="wrapper">
        @include('layouts.header')
        <main>
            <div class="container">
                <h1 class="fs-2 my-3">@yield('title')</h1>
                @yield('content')
            </div>
        </main>
        @include('layouts.footer')
    </div>

    {{-- Bootstrap の JavaScript を最後に読み込む --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>