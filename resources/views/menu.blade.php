@extends('layouts.app')

@section('title', ($active ? $active->name.' · ' : '').'Menu · Maison Céval')
@section('description', 'The full Maison Céval menu with prices: Basque burnt cheesecakes, pie tarts, Chizu, Dubai kunafa treats and seasonal collections.')

@section('content')

    <section class="page-hero">
        <div class="container">
            <p class="eyebrow eyebrow--center">Menu</p>
            <h1 class="page-hero__title">{{ $active?->name ?? 'Our Menu' }}</h1>
            <p class="page-hero__lead">
                {{ $active?->description ?? 'Every cake, tart and treat we bake, with prices. Everything is made to order.' }}
            </p>
        </div>
    </section>

    <section class="section section--flush-top">
        <div class="container">
            <nav class="filter" aria-label="Filter by category">
                <a href="{{ route('menu') }}" class="filter__pill {{ $active ? '' : 'is-active' }}">All</a>
                @foreach ($categories as $category)
                    <a href="{{ route('menu', ['category' => $category->slug]) }}"
                       class="filter__pill {{ $active?->is($category) ? 'is-active' : '' }}">{{ $category->name }}</a>
                @endforeach
            </nav>

            @if ($menus->isEmpty())
                <p class="empty-state">No cakes here yet. Please check back soon.</p>
            @endif

            @foreach ($groups as $group)
                <div class="menu-group" id="{{ $group['catalog']->slug }}" style="--accent: {{ $group['catalog']->accent }}">
                    <div class="menu-group__head">
                        <h2 class="menu-group__title">{{ $group['catalog']->name }}</h2>
                        @if ($group['catalog']->tagline)
                            <p>{{ $group['catalog']->tagline }}</p>
                        @endif
                        <a href="{{ route('catalog.show', $group['catalog']) }}" class="link-arrow menu-group__link">View catalog <span aria-hidden="true">&rarr;</span></a>
                    </div>
                    <div class="product-grid">
                        @foreach ($group['menus'] as $menu)
                            <x-product-card :menu="$menu" :show-catalog="false" />
                        @endforeach
                    </div>
                </div>
            @endforeach

            @if ($uncatalogued->isNotEmpty())
                <div class="menu-group">
                    <div class="menu-group__head"><h2 class="menu-group__title">More</h2></div>
                    <div class="product-grid">
                        @foreach ($uncatalogued as $menu)
                            <x-product-card :menu="$menu" :show-catalog="false" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    @include('partials.how-to-order')

@endsection
