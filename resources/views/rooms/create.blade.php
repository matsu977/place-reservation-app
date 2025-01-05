<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel Vite Vue.js 3</title>
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])

        @php
            $user = auth()->user();
            $userData = [
                'id' => $user->id,
                'team_id' => $user->team_id,
                'name' => $user->name,
                'email' => $user->email
            ];
        @endphp

        <script>
            window.auth = {
                user: @json($userData)
            };
            console.log('User auth data:', window.auth); // デバッグ用
        </script>
    </head>
    <body>
        <div id="app"></div>
    </body>
</html>