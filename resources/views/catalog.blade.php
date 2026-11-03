@extends('layouts.app')

@section('title', $catalog->name.' · Maison Céval')
@section('description', Str::limit($catalog->description ?: $catalog->tagline ?: $catalog->name, 150))
@section('og_image', $catalog->image_url)

@section('content')

    <section class="catalog-hero {{ $catalog->is_seasonal ? 'catalog-hero--seasonal' : '' }}" style="--accent: {{ $catalog->accent }}">
        {{-- Decoration: a soft pattern of the cake logo, plus twinkling lights for seasonal catalogs. --}}
        <div class="catalog-hero__pattern" aria-hidden="true"></div>
        @if ($catalog->is_seasonal)
            <div class="catalog-hero__lights" aria-hidden="true"></div>
        @endif
        <div class="container catalog-hero__grid">
            <div class="catalog-hero__copy">
                <p class="eyebrow eyebrow--gold">
                    {{ $catalog->is_seasonal ? 'Limited edition' : 'All year round' }} · {{ $menus->count() }} {{ Str::plural('item', $menus->count()) }}
                </p>
                <h1 class="catalog-hero__title">{{ $catalog->name }}</h1>
                @if ($catalog->description || $catalog->tagline)
                    <p class="catalog-hero__lead">{{ $catalog->description ?: $catalog->tagline }}</p>
                @endif
                <a href="#products" class="btn btn--gold">See the products</a>
            </div>
            <div class="catalog-hero__visual">
                <div class="arch arch--gold">
                    <img src="{{ $catalog->image_url }}" alt="{{ $catalog->name }}" width="900" height="1200" fetchpriority="high">
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="products">
        <div class="container">
            @forelse ($groups as $group)
                <div class="menu-group">
                    <div class="menu-group__head">
                        <h2 class="menu-group__title">{{ $group['category']->name ?? 'More' }}</h2>
                        @if ($group['category']?->description)
                            <p>{{ $group['category']->description }}</p>
                        @endif
                    </div>
                    <div class="product-grid">
                        @foreach ($group['menus'] as $menu)
                            <x-product-card :menu="$menu" :show-catalog="false" />
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="empty-state">Products for this catalog will be announced soon.</p>
            @endforelse
        </div>
    </section>

    @if ($otherCatalogs->isNotEmpty())
        <section class="section section--tint">
            <div class="container">
                <div class="section-head">
                    <div>
                        <p class="eyebrow">Keep exploring</p>
                        <h2 class="section-title">Other catalogs</h2>
                    </div>
                </div>
                <div class="catalog-cards">
                    @foreach ($otherCatalogs as $other)
                        <x-catalog-card :catalog="$other" size="small" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('partials.how-to-order')

@endsection
