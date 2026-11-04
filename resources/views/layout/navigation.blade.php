{{-- Navigation bar. $active comes from the controller: 'home', 'catalog' or 'menu' --}}
<header class="site-header" data-header>
    <div class="container site-header__inner">
        <a href="/" class="brand" aria-label="Maison Céval home">
            <img src="/images/logo-mark.png" alt="" class="brand__mark" width="190" height="222">
            <img src="/images/logo-wordmark.png" alt="Maison Céval" class="brand__word" width="584" height="240">
        </a>

        <nav class="site-nav" id="site-nav" aria-label="Main">
            <ul class="site-nav__list">
                <li><a href="/" class="site-nav__link {{ $active == 'home' ? 'is-active' : '' }}">Home</a></li>
                <li><a href="/#catalogs" class="site-nav__link {{ $active == 'catalog' ? 'is-active' : '' }}">Catalog</a></li>
                <li><a href="/menu" class="site-nav__link {{ $active == 'menu' ? 'is-active' : '' }}">Menu</a></li>
            </ul>

            <a href="#ordering" class="btn btn--small site-nav__cta">Order now</a>
        </nav>

        <button class="nav-toggle" type="button" aria-controls="site-nav" aria-expanded="false" data-nav-toggle>
            <span class="nav-toggle__bar"></span>
            <span class="nav-toggle__bar"></span>
            <span class="sr-only">Open menu</span>
        </button>
    </div>
</header>
