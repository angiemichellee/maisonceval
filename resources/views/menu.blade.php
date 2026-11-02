@extends('layouts.app')

@section('title', ($active ? $active->name.' · ' : '').'Menu · Maison Céval')
@section('description', 'The Maison Céval everyday menu: Basque burnt cheesecakes, pie tarts, Chizu, Dubai kunafa treats and more, with prices.')

@section('content')

    <section class="page-hero">
        <div class="container">
            <p class="eyebrow eyebrow--center">Everyday menu</p>
            <h1 class="page-hero__title">{{ $active?->name ?? 'Our Menu' }}</h1>
            <p class="page-hero__lead">
                {{ $active?->description ?? 'Signature cheesecakes, tarts and little treats, baked to order all year round.' }}
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
                <a href="{{ route('christmas') }}" class="filter__pill filter__pill--festive">Christmas &#10022;</a>
            </nav>

            @if ($menus->isEmpty())
                <p class="empty-state">No cakes here yet. Please check back soon.</p>
            @elseif ($active)
                <div class="product-grid">
                    @foreach ($menus as $menu)
                        <x-product-card :menu="$menu" :show-category="false" />
                    @endforeach
                </div>
            @else
                @foreach ($groups as $group)
                    <div class="menu-group" id="{{ $group['category']->slug }}">
                        <div class="menu-group__head">
                            <h2 class="menu-group__title">{{ $group['category']->name }}</h2>
                            <p>{{ $group['category']->description }}</p>
                        </div>
                        <div class="product-grid">
                            @foreach ($group['menus'] as $menu)
                                <x-product-card :menu="$menu" :show-category="false" />
                            @endforeach
                        </div>
                    </div>
                @endforeach

                @if ($uncategorised->isNotEmpty())
                    <div class="menu-group">
                        <div class="menu-group__head"><h2 class="menu-group__title">More</h2></div>
                        <div class="product-grid">
                            @foreach ($uncategorised as $menu)
                                <x-product-card :menu="$menu" :show-category="false" />
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </section>

    @include('partials.how-to-order')

@endsection
