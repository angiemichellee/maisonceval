@extends('layouts.app')

@section('body_class', 'page-home')

@section('content')

    {{-- ============ HERO ============ --}}
    <section class="hero">
        <div class="container hero__grid">
            <div class="hero__copy">
                <p class="eyebrow">Cake shop · Since 2020</p>
                <h1 class="hero__title">Pure taste.<br><em>Pure class.</em></h1>
                <p class="hero__lead">
                    Basque burnt cheesecakes, buttery tarts and little treats, baked to order
                    with the finest ingredients and a quiet attention to every detail.
                </p>
                <div class="hero__actions">
                    <a href="{{ route('menu') }}" class="btn">Explore the menu</a>
                    <a href="{{ route('christmas') }}" class="btn btn--ghost">Christmas collection</a>
                </div>

                <dl class="hero__facts">
                    <div><dt>Speciality</dt><dd>Burnt cheesecake</dd></div>
                    <div><dt>Baked</dt><dd>To order</dd></div>
                    <div><dt>Since</dt><dd>2020</dd></div>
                </dl>
            </div>

            <div class="hero__visual">
                <div class="arch hero__arch">
                    <img src="{{ asset('images/products/iceberg-cheesecake.jpg') }}" alt="Iceberg cheesecake with a thick chocolate layer" width="800" height="1200" fetchpriority="high">
                </div>
                <div class="hero__inset">
                    <img src="{{ asset('images/products/lemon-pie-tart.jpg') }}" alt="Lemon pie tart" width="800" height="1200">
                </div>
                <div class="hero__seal" aria-hidden="true">
                    <svg viewBox="0 0 120 120">
                        <defs><path id="seal-circle" d="M60,60 m-46,0 a46,46 0 1,1 92,0 a46,46 0 1,1 -92,0"/></defs>
                        <text><textPath href="#seal-circle">MAISON CÉVAL · PURE TASTE · PURE CLASS ·</textPath></text>
                    </svg>
                    <img src="{{ asset('images/logo-mark.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    {{-- ============ RIBBON ============ --}}
    <div class="ribbon" aria-hidden="true">
        <div class="ribbon__track">
            @for ($i = 0; $i < 2; $i++)
                <span>Burnt Cheesecake</span><i></i>
                <span>Lemon Pie Tart</span><i></i>
                <span>Iceberg</span><i></i>
                <span>Matcha</span><i></i>
                <span>Dubai Kunafa</span><i></i>
                <span>Chizu</span><i></i>
                <span>Bucket Brownies</span><i></i>
            @endfor
        </div>
    </div>

    {{-- ============ STORY ============ --}}
    <section class="section story" id="story">
        <div class="container story__grid">
            <div class="story__media" data-reveal>
                <div class="arch arch--soft">
                    <img src="{{ asset('images/products/matcha-cheesecake.jpg') }}" alt="Matcha cheesecake beside a Maison Céval box" loading="lazy" width="900" height="1200">
                </div>
            </div>
            <div class="story__copy" data-reveal>
                <p class="eyebrow">Our story</p>
                <h2 class="section-title">Every cake has a story. Every moment deserves something special.</h2>
                <p>
                    Maison Céval brings you flavours and experiences that put quality, beauty and attention
                    to detail first. We believe every bake has a story, and every moment deserves to be
                    celebrated with something special.
                </p>
                <p>
                    From our caramelised Basque burnt cheesecakes to buttery tarts and gift-ready cups,
                    each piece is made to order and finished by hand, whether it is for a birthday,
                    a thank-you or a quiet afternoon at home.
                </p>
                <a href="{{ route('menu') }}" class="link-arrow">Discover our cakes <span aria-hidden="true">&rarr;</span></a>
            </div>
        </div>
    </section>

    {{-- ============ SIGNATURES ============ --}}
    @if ($featured->isNotEmpty())
        <section class="section section--tint">
            <div class="container">
                <div class="section-head">
                    <div>
                        <p class="eyebrow">Most loved</p>
                        <h2 class="section-title">Signature bakes</h2>
                    </div>
                    <a href="{{ route('menu') }}" class="link-arrow">See the full menu <span aria-hidden="true">&rarr;</span></a>
                </div>

                <div class="product-grid">
                    @foreach ($featured as $menu)
                        <x-product-card :menu="$menu" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ CATEGORIES ============ --}}
    @if ($categories->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="section-head section-head--center">
                    <p class="eyebrow eyebrow--center">Browse</p>
                    <h2 class="section-title">Find your favourite</h2>
                </div>

                <div class="category-tiles">
                    @foreach ($categories as $category)
                        @php $cover = $category->menus->first(); @endphp
                        <a href="{{ route('menu', ['category' => $category->slug]) }}" class="category-tile" data-reveal>
                            <div class="arch category-tile__media">
                                @if ($cover)
                                    <img src="{{ $cover->image_url }}" alt="{{ $category->name }}" loading="lazy" width="600" height="800">
                                @endif
                            </div>
                            <h3 class="category-tile__name">{{ $category->name }}</h3>
                            <p class="category-tile__desc">{{ $category->description }}</p>
                            <span class="category-tile__count">{{ $category->menus_count }} {{ Str::plural('item', $category->menus_count) }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ CHRISTMAS ============ --}}
    @if ($christmas->isNotEmpty())
        <section class="festive-band">
            <div class="container festive-band__grid">
                <div class="festive-band__copy" data-reveal>
                    <p class="eyebrow eyebrow--gold">Limited edition</p>
                    <h2 class="festive-band__title">The Christmas Collection</h2>
                    <p>
                        Our favourite cheesecakes and gift cups, dressed for the season. Every order comes with
                        a Merry Christmas topper, a greeting card and a ribbon, ready to give.
                    </p>
                    <a href="{{ route('christmas') }}" class="btn btn--gold">Shop Christmas</a>
                </div>

                <div class="festive-band__gallery">
                    @foreach ($christmas as $menu)
                        <a href="{{ route('menu.show', $menu) }}" class="festive-thumb" data-reveal>
                            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" loading="lazy" width="400" height="600">
                            <span class="festive-thumb__label">
                                <span>{{ str_replace('Christmas ', '', $menu->name) }}</span>
                                <strong>{{ $menu->price_label }}</strong>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ HOW TO ORDER ============ --}}
    @include('partials.how-to-order')

@endsection
