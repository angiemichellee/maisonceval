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
                    <a href="{{ route('catalog.index') }}" class="btn">Explore our catalogs</a>
                    <a href="{{ route('menu') }}" class="btn btn--ghost">See the menu</a>
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

    {{-- ============ CATALOGS (from the database) ============ --}}
    @if ($catalogs->isNotEmpty())
        <section class="section section--tint" id="catalogs">
            <div class="container">
                <div class="section-head">
                    <div>
                        <p class="eyebrow">Our catalogs</p>
                        <h2 class="section-title">Something for every season</h2>
                    </div>
                    <a href="{{ route('catalog.index') }}" class="link-arrow">All catalogs <span aria-hidden="true">&rarr;</span></a>
                </div>

                <div class="catalog-cards">
                    @foreach ($catalogs as $catalog)
                        <x-catalog-card :catalog="$catalog" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ FIND YOUR FAVOURITE ============ --}}
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

    {{-- ============ HOW TO ORDER ============ --}}
    @include('partials.how-to-order')

@endsection
