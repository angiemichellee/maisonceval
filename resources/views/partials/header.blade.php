@php
    // A page can force the highlighted item with @section('nav', 'menu').
    $forced = trim($__env->yieldContent('nav'));
    $isActive = fn (string $key, array $patterns) => $forced !== '' ? $forced === $key : request()->routeIs(...$patterns);

    $links = [
        ['label' => 'Home', 'href' => route('home'), 'active' => $isActive('home', ['home'])],
        // Scrolls to the catalogs section on the home page.
        ['label' => 'Catalog', 'href' => route('home').'#catalogs', 'active' => $isActive('catalog', ['catalog.show'])],
        ['label' => 'Menu', 'href' => route('menu'), 'active' => $isActive('menu', ['menu', 'menu.show'])],
    ];
@endphp

<header class="site-header" data-header>
    <div class="container site-header__inner">
        <a href="{{ route('home') }}" class="brand" aria-label="Maison Céval home">
            <img src="{{ asset('images/logo-mark.png') }}" alt="" class="brand__mark" width="190" height="222">
            <img src="{{ asset('images/logo-wordmark.png') }}" alt="Maison Céval" class="brand__word" width="584" height="240">
        </a>

        <nav class="site-nav" id="site-nav" aria-label="Main">
            <ul class="site-nav__list">
                @foreach ($links as $link)
                    <li>
                        <a href="{{ $link['href'] }}"
                           class="site-nav__link {{ $link['active'] ? 'is-active' : '' }}"
                           @if ($link['active']) aria-current="page" @endif>
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Every page has the "Ordering" section (partials/how-to-order). --}}
            <a href="#ordering" class="btn btn--small site-nav__cta">Order now</a>
        </nav>

        <button class="nav-toggle" type="button" aria-controls="site-nav" aria-expanded="false" data-nav-toggle>
            <span class="nav-toggle__bar"></span>
            <span class="nav-toggle__bar"></span>
            <span class="sr-only">Open menu</span>
        </button>
    </div>
</header>
