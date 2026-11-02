@extends('layouts.app')

@section('title', $menu->name.' · Maison Céval')
@section('description', Str::limit($menu->description, 150))
@section('og_image', $menu->image_url)
@section('nav', $menu->is_christmas ? 'christmas' : 'menu')
@section('body_class', $menu->is_christmas ? 'page-product page-product--festive' : 'page-product')

@php
    $backRoute = $menu->is_christmas ? route('christmas') : route('menu');
    $message = "Hello Maison Céval, I would like to order the {$menu->name} ({$menu->price_label}).";
    $orderUrl = $contact->orderUrl($message);
@endphp

@section('content')

    <section class="product">
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">/</span>
                <a href="{{ $backRoute }}">{{ $menu->catalog_label }}</a>
                @if ($menu->category)
                    <span aria-hidden="true">/</span>
                    <span>{{ $menu->category->name }}</span>
                @endif
            </nav>

            <div class="product__grid">
                <div class="product__media">
                    <div class="arch {{ $menu->is_christmas ? 'arch--gold' : '' }}">
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" width="900" height="1200">
                    </div>
                </div>

                <div class="product__info">
                    <p class="eyebrow">{{ $menu->is_christmas ? 'Christmas Collection' : ($menu->category->name ?? 'Maison Céval') }}</p>
                    <h1 class="product__name">{{ $menu->display_name }}</h1>
                    <p class="product__price">{{ $menu->price_label }}</p>

                    <p class="product__desc">{{ $menu->description }}</p>

                    @if (! empty($menu->variants))
                        <div class="product__block">
                            <h2 class="product__label">{{ count($menu->variants) > 1 ? 'Choose a flavour' : 'Flavour' }}</h2>
                            <ul class="variant-list">
                                @foreach ($menu->variants as $variant)
                                    <li class="variant">
                                        <span>{{ $variant['name'] }}</span>
                                        @if (! empty($variant['price']))
                                            <strong>{{ \App\Models\Menu::rupiah($variant['price']) }}</strong>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($menu->includes)
                        <div class="product__block product__includes">
                            <h2 class="product__label">Includes</h2>
                            <p><span aria-hidden="true">&#10022;</span> {{ $menu->includes }}</p>
                        </div>
                    @endif

                    <div class="product__actions">
                        @if ($orderUrl)
                            <a href="{{ $orderUrl }}" class="btn {{ $menu->is_christmas ? 'btn--festive' : '' }}" target="_blank" rel="noopener">
                                Order via {{ $contact->orderChannel() }}
                            </a>
                        @endif
                        <a href="{{ $backRoute }}" class="btn btn--ghost">Back to {{ $menu->is_christmas ? 'collection' : 'menu' }}</a>
                    </div>

                    <p class="product__note">Baked to order. Please order ahead and tell us the date you need it.</p>
                </div>
            </div>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="section section--tint">
            <div class="container">
                <div class="section-head">
                    <div>
                        <p class="eyebrow">You may also like</p>
                        <h2 class="section-title">More from the {{ $menu->is_christmas ? 'collection' : 'menu' }}</h2>
                    </div>
                </div>
                <div class="product-grid">
                    @foreach ($related as $item)
                        <x-product-card :menu="$item" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
