<!DOCTYPE html>
<html lang="sl-Sl" class="{{ $_COOKIE['color-scheme'] ?? 'light' }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0"/>
    <meta name="monetization" content="$ilp.uphold.com/44LefdKYfgnr">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#9dc02e">
    <link rel="shortcut icon" href="/images/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    {{-- Twitter tags --}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:image" content="/images/logoTwitter1200x600.jpg">
    {{-- Facebook tags --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="/">
    <meta property="og:image" content="/images/logoOpenGraph1200x630.jpg">
    <meta property="og:image:secure_url" content="/images/logoOpenGraph1200x630.jpg">
    <meta property="og:image:type" content="jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    @if (app()->environment('production') )
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')))
        @endphp
        <script type="module" src="/build/{{ $manifest->{'resources/js/app.ts'}->{'file'} }}"></script>
        <link rel="stylesheet" href="/build/{{ $manifest->{'resources/js/app.ts'}->{'css'}[0] }}" />
    @else
        <script type="module" src="http://localhost:3000/resources/js/app.js"></script>
    @endif
</head>
<body class="dark:bg-zinc-900 colors-transition">
@inertia
</body>
</html>
