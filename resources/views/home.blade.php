@extends('layout.mainlayout')

@section('title', $title)

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
                    <a href="/menu" class="btn">See the menu</a>
                    <a href="#ordering" class="btn btn--ghost">How to order</a>
                </div>

                <dl class="hero__facts">
                    <div><dt>Speciality</dt><dd>Burnt cheesecake</dd></div>
                    <div><dt>Baked</dt><dd>To order</dd></div>
                    <div><dt>Since</dt><dd>2020</dd></div>
                </dl>
            </div>

            <div class="hero__visual">
                <div class="arch hero__arch">
                    <img src="/images/products/iceberg-cheesecake.jpg" alt="Iceberg cheesecake with a thick chocolate layer" width="800" height="1200" fetchpriority="high">
                </div>
                <div class="hero__inset">
                    <img src="/images/products/lemon-pie-tart.jpg" alt="Lemon pie tart" width="800" height="1200">
                </div>
                <div class="hero__seal" aria-hidden="true">
                    <svg viewBox="0 0 120 120">
                        <defs><path id="seal-circle" d="M60,60 m-46,0 a46,46 0 1,1 92,0 a46,46 0 1,1 -92,0"/></defs>
                        <text><textPath href="#seal-circle">MAISON CÉVAL · PURE TASTE · PURE CLASS ·</textPath></text>
                    </svg>
                    <img src="/images/logo-mark.png" alt="">
                </div>
            </div>
        </div>
    </section>

    {{-- ============ CATALOGS (from the catalogs table) ============ --}}
    <section class="section section--tint" id="catalogs">
        <div class="container">
            <div class="section-head">
                <div>
                    <p class="eyebrow">Our catalogs</p>
                    <h2 class="section-title">Something for every season</h2>
                </div>
            </div>

            <div class="catalog-cards">
                @foreach ($catalogs as $catalog)
                    @include('layout.catalogcard', ['catalog' => $catalog])
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ FIND YOUR FAVOURITE (from the categories table) ============ --}}
    <section class="section">
        <div class="container">
            <div class="section-head section-head--center">
                <p class="eyebrow eyebrow--center">Browse</p>
                <h2 class="section-title">Find your favourite</h2>
            </div>

            <div class="category-tiles">
                @foreach ($categories as $category) {{-- dari HomeController --}}
                    @php
                        // menyaring perkategori dan menyimpan yg id pertama buat cover photo
                        $items = $menus->where('category_id', $category->id); 
                    @endphp

                    @continue($items->isEmpty()) {{-- kl kategori ga pny menu lgsng lanjut ke kategori lain --}}

                    <a href="/menu/category/{{ $category->slug }}" class="category-tile" data-reveal> {{-- /menu/category/everyday --}}
                        <div class="arch category-tile__media">
                            <img src="/{{ $items->first()->image }}" alt="{{ $category->name }}" loading="lazy" width="600" height="800">
                        </div>
                        <h3 class="category-tile__name">{{ $category->name }}</h3>
                        <p class="category-tile__desc">{{ $category->description }}</p>
                        <span class="category-tile__count">{{ $items->count() }} items</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

@endsection
