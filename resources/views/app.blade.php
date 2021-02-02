<!DOCTYPE html>
<html lang="sl_SI" class="{{ isset($_COOKIE['color-scheme']) ? $_COOKIE['color-scheme'] : 'light' }}">
<head>
    <meta charset="utf-8"/>
    <title>Register divjih odlagališč Slovenije</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script>window.globalData = {!! \App\Http\Controllers\PageDataController::global() !!}</script>
</head>
<body class="dark:bg-dark-main">
@inertia
</body>
</html>
