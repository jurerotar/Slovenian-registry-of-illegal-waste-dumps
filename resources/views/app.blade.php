<!DOCTYPE html>
<html lang="sl_SI" class="{{ isset($_COOKIE['color-scheme']) ? $_COOKIE['color-scheme'] : 'light' }}">
<head>
    <meta charset="utf-8"/>
    <title>Register divjih odlagališč Slovenije</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#9dc02e">
    <link rel="shortcut icon" href="/images/favicon/favicon.ico">
    <meta name="monetization" content="$ilp.uphold.com/44LefdKYfgnr">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Fill this -->
    <meta name="description" content="">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Register divjih odlagališč Slovenije">
    <!-- Fill this -->
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="/images/logoTwitter1200x600.jpg">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Register divjih odlagališč Slovenije">
    <!-- Fill this -->
    <meta property="og:url" content="">
    <!-- Fill this -->
    <meta property="og:description" content="">
    <!-- Create this -->
    <meta property="og:image" content="/images/logoOpenGraph1200x630.jpg">
    <meta property="og:image:secure_url" content="/images/logoOpenGraph1200x630.jpg">
    <meta property="og:image:type" content="jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Register divjih odlagališč Slovenije">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script>window.globalData = {!! (new \App\Http\Controllers\PageDataController)->global() !!}</script>
</head>
<body class="dark:bg-dark-main duration-300 transition-colors">
@inertia
</body>
</html>
