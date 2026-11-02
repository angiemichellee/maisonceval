@php
    // A page can force the highlighted item with @section('nav', 'christmas').
    $forced = trim($__env->yieldContent('nav'));
    $isActive = fn (string $route, array $patterns) => $forced !== '' ? $forced === $route : request()->routeIs(...$patterns);

    $links = [
        ['label' => 'Home', 'route' => 'home', 'active' => $isActive('home', ['home'])],
        ['label' => 'Menu', 'route' => 'menu', 'active' => $isActive('menu', ['menu', 'menu.show'])],
        ['label' => 'Christmas', 'route' => 'christmas', 'active' => $isActive('christmas', ['christmas'])],
        ['label' => 'Category', 'route' => 'category', 'active' => $isActive('category', ['category'])],
        ['label' => 'Contact', 'route' => 'contact', 'active' => $isActive('contact', ['contact'])],
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
                        <a href="{{ route($link['route']) }}"
                           class="site-nav__link {{ $link['active'] ? 'is-active' : '' }} {{ $link['route'] === 'christmas' ? 'site-nav__link--festive' : '' }}"
                           @if ($link['active']) aria-current="page" @endif>
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            @if ($orderUrl = $contact->orderUrl())
                <a href="{{ $orderUrl }}" class="btn btn--small site-nav__cta" target="_blank" rel="noopener">Order now</a>
            @endif
        </nav>

        <button class="nav-toggle" type="button" aria-controls="site-nav" aria-expanded="false" data-nav-toggle>
            <span class="nav-toggle__bar"></span>
            <span class="nav-toggle__bar"></span>
            <span class="sr-only">Open menu</span>
        </button>
    </div>
</header>
