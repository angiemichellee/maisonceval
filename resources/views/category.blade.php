@extends('layouts.app')

@section('title', 'Categories · Maison Céval')
@section('description', 'Browse Maison Céval by catalog and category: cheesecakes, tarts, little treats and the Christmas collection.')

@section('content')

    <section class="page-hero">
        <div class="container">
            <p class="eyebrow eyebrow--center">Our catalogs</p>
            <h1 class="page-hero__title">Browse by category</h1>
            <p class="page-hero__lead">Two catalogs, one promise: pure taste, pure class.</p>
        </div>
    </section>

    <section class="section section--flush-top">
        <div class="container">
            <div class="catalog-cards">
                @foreach ($catalogs as $catalog)
                    <a href="{{ $catalog['url'] }}" class="catalog-card {{ $catalog['festive'] ? 'catalog-card--festive' : '' }}" data-reveal>
                        <img src="{{ $catalog['image'] }}" alt="" loading="lazy" width="900" height="1200">
                        <div class="catalog-card__body">
                            <span class="catalog-card__count">{{ $catalog['count'] }} {{ Str::plural('item', $catalog['count']) }}</span>
                            <h2 class="catalog-card__name">{{ $catalog['name'] }}</h2>
                            <p>{{ $catalog['tagline'] }}</p>
                            <span class="catalog-card__cta">Explore &rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section--tint">
        <div class="container">
            <div class="section-head section-head--center">
                <p class="eyebrow eyebrow--center">Everyday menu</p>
                <h2 class="section-title">Categories</h2>
            </div>

            <div class="category-list">
                @foreach ($categories as $category)
                    <div class="category-row" data-reveal>
                        <div class="category-row__intro">
                            <h3 class="category-row__name">{{ $category->name }}</h3>
                            <p>{{ $category->description }}</p>
                            <a href="{{ route('menu', ['category' => $category->slug]) }}" class="link-arrow">
                                View all {{ $category->menus_count }} <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                        <ul class="category-row__items">
                            @foreach ($category->menus as $menu)
                                <li>
                                    <a href="{{ route('menu.show', $menu) }}" class="mini-item">
                                        <img src="{{ $menu->image_url }}" alt="" loading="lazy" width="96" height="96">
                                        <span class="mini-item__name">{{ $menu->name }}</span>
                                        <span class="mini-item__price">{{ $menu->price_label }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
