{{-- Main layout: every page uses @extends('layout.mainlayout') and fills @section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Maison Céval')</title>
    <meta name="description" content="Maison Céval is a cake shop baking Basque burnt cheesecakes, tarts and little treats since 2020. Pure taste. Pure class.">
    <meta name="theme-color" content="#FAF8F2">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600&family=Marcellus&display=swap" rel="stylesheet">

    {{-- Change the ?v= number after editing the CSS, so browsers load the new version --}}
    <link rel="stylesheet" href="/css/maison.css?v=6">
    <script>document.documentElement.classList.add('js');</script>
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>

    @include('layout.navigation')

    <main id="main">
        @yield('content')

        {{-- "How to order" section, on every page (the "Order now" button scrolls here) --}}
        @include('layout.ordering')
    </main>

    @include('layout.footer')

    <script src="/js/maison.js?v=6" defer></script>
</body>
</html>
