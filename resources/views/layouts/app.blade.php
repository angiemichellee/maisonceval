@php
    // Cache-busting version for CSS/JS. Safe on shared hosting where the public
    // folder may live elsewhere (e.g. public_html): falls back to a fixed value.
    $assetVersion = function (string $path) {
        $file = public_path($path);

        return is_file($file) ? filemtime($file) : '1';
    };
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Maison Céval · Pure Taste. Pure Class.')</title>
    <meta name="description" content="@yield('description', 'Maison Céval is a cake shop baking Basque burnt cheesecakes, tarts and little treats since 2020. Pure taste. Pure class.')">
    <meta name="theme-color" content="#FAF8F2">

    <meta property="og:title" content="@yield('title', 'Maison Céval')">
    <meta property="og:description" content="@yield('description', 'Basque burnt cheesecakes, tarts and little treats. Pure taste. Pure class.')">
    <meta property="og:image" content="@yield('og_image', asset('images/products/iceberg-cheesecake.jpg'))">

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600&family=Marcellus&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/maison.css') }}?v={{ $assetVersion('css/maison.css') }}">
    <script>document.documentElement.classList.add('js');</script>
</head>
<body class="@yield('body_class')">
    <a class="skip-link" href="#main">Skip to content</a>

    @include('partials.header')

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ asset('js/maison.js') }}?v={{ $assetVersion('js/maison.js') }}" defer></script>
</body>
</html>
