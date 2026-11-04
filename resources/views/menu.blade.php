@extends('layout.mainlayout')

@section('title', $title)

@section('content')

    <section class="page-hero">
        <div class="container">
            <p class="eyebrow eyebrow--center">Menu</p>

            @if ($selected == null)
                <h1 class="page-hero__title">Our Menu</h1>
                <p class="page-hero__lead">Every cake, tart and treat we bake, with prices. Everything is made to order.</p>
            @else
                <h1 class="page-hero__title">{{ $selected->name }}</h1>
                <p class="page-hero__lead">{{ $selected->description }}</p>
            @endif
        </div>
    </section>

    <section class="section section--flush-top">
        <div class="container">

            {{-- Category filter: All / Cheesecakes / Tarts / Little Treats --}}
            <nav class="filter" aria-label="Filter by category">
                <a href="/menu" class="filter__pill {{ $selected == null ? 'is-active' : '' }}">All</a>
                @foreach ($categories as $category)
                    <a href="/menu/category/{{ $category->slug }}"
                       class="filter__pill {{ $selected != null && $selected->id == $category->id ? 'is-active' : '' }}">{{ $category->name }}</a>
                @endforeach
            </nav>

            @if ($menus->isEmpty())
                <p class="empty-state">No cakes here yet. Please check back soon.</p>
            @endif

            {{-- One section per catalog: Everyday Menu, Christmas Collection, ... --}}
            @foreach ($catalogs as $catalog)
                @php
                    $items = $menus->where('catalog_id', $catalog->id);
                @endphp

                @continue($items->isEmpty())

                <div class="menu-group" id="{{ $catalog->slug }}" style="--accent: {{ $catalog->color }}">
                    <div class="menu-group__head">
                        <h2 class="menu-group__title">{{ $catalog->name }}</h2>
                        <p>{{ $catalog->tagline }}</p>
                        <a href="/catalog/{{ $catalog->slug }}" class="link-arrow menu-group__link">View catalog <span aria-hidden="true">&rarr;</span></a>
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

@endsection
