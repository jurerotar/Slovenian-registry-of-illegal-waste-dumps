<!DOCTYPE html>
<html lang="sl_SI" class="{{ $_COOKIE['color-scheme'] ?? 'light' }}">
<head>
    <meta charset="utf-8"/>
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('/images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ url('/images/favicon/safari-pinned-tab.svg') }}" color="#9dc02e">
    <link rel="shortcut icon" href="{{ url('/images/favicon/favicon.ico') }}">
    <meta name="monetization" content="$ilp.uphold.com/44LefdKYfgnr">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="{{ url('/images/favicon/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="description"
          content="{{ $description }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description"
          content="{{ $description }}">
    <meta name="twitter:image" content="{{ url('/images/logoTwitter1200x600.jpg') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:description"
          content="{{ $description }}">
    <meta property="og:image" content="{{ url('/images/logoOpenGraph1200x630.jpg') }}">
    <meta property="og:image:secure_url" content="{{ url('/images/logoOpenGraph1200x630.jpg') }}">
    <meta property="og:image:type" content="jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $title }}">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script>window.globalData = {!! (new \App\Http\Controllers\GlobalDataController)->index() !!}</script>
</head>
<body class="dark:bg-dark-main duration-300 transition-colors">
@inertia
</body>
</html>
