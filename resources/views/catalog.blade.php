@extends('layout.mainlayout')

@section('title', $title)

@section('content')

    {{-- ============ BANNER (colour from the catalog's "color" column) ============ --}}
    <section class="catalog-hero {{ $catalog->is_seasonal ? 'catalog-hero--seasonal' : '' }}" style="--accent: {{ $catalog->color }}">
        <div class="catalog-hero__lights" aria-hidden="true"></div>
        <div class="container catalog-hero__grid">
            <div class="catalog-hero__copy">
                <p class="eyebrow eyebrow--gold">
                    {{ $catalog->is_seasonal ? 'Limited edition' : 'All year round' }} · {{ $menus->count() }} items
                </p>
                <h1 class="catalog-hero__title">{{ $catalog->name }}</h1>
                <p class="catalog-hero__lead">{{ $catalog->description }}</p>
                <a href="#products" class="btn btn--gold">See the products</a>
            </div>
            <div class="catalog-hero__visual">
                <div class="arch arch--gold">
                    <img src="/{{ $catalog->image }}" alt="{{ $catalog->name }}" width="900" height="1200" fetchpriority="high">
                </div>
            </div>
        </div>
    </section>

    {{-- ============ PRODUCTS, grouped by category ============ --}}
    <section class="section" id="products">
        <div class="container">
            @if ($menus->isEmpty())
                <p class="empty-state">Products for this catalog will be announced soon.</p>
            @endif

            @foreach ($categories as $category)
                @php
                    $items = $menus->where('category_id', $category->id);
                @endphp

                @continue($items->isEmpty())

                <div class="menu-group">
                    <div class="menu-group__head">
                        <h2 class="menu-group__title">{{ $category->name }}</h2>
                        <p>{{ $category->description }}</p>
                    </div>
                    <div class="product-grid">
                        @foreach ($items as $menu)
                            @include('layout.productcard', ['menu' => $menu])
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============ OTHER CATALOGS ============ --}}
    @if ($catalogs->count() > 1)
        <section class="section section--tint">
            <div class="container">
                <div class="section-head">
                    <div>
                        <p class="eyebrow">Keep exploring</p>
                        <h2 class="section-title">Other catalogs</h2>
                    </div>
                </div>
                <div class="catalog-cards">
                    @foreach ($catalogs as $other)
                        @continue($other->id == $catalog->id)
                        @include('layout.catalogcard', ['catalog' => $other])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
