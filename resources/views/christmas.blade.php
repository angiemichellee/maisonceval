@extends('layouts.app')

@section('title', 'Christmas Collection · Maison Céval')
@section('description', 'The Maison Céval Christmas collection: festive cheesecakes and gift cups with a Merry Christmas topper, greeting card and ribbon.')
@section('og_image', asset('images/products/xmas-matcha-cheesecake.jpg'))
@section('body_class', 'page-christmas')

@section('content')

    <section class="xmas-hero">
        <div class="xmas-hero__lights" aria-hidden="true"></div>
        <div class="container xmas-hero__grid">
            <div class="xmas-hero__copy">
                <p class="eyebrow eyebrow--gold">Limited edition · Season {{ date('Y') }}</p>
                <h1 class="xmas-hero__title">The Christmas<br><em>Collection</em></h1>
                <p class="xmas-hero__lead">
                    Our most-loved cheesecakes and gift cups, dressed for the holidays.
                    A little elegance for every table, and the easiest gift to give.
                </p>
                <ul class="xmas-perks">
                    <li><span aria-hidden="true">&#10022;</span> Merry Christmas topper</li>
                    <li><span aria-hidden="true">&#10022;</span> Greeting card</li>
                    <li><span aria-hidden="true">&#10022;</span> Gift ribbon</li>
                </ul>
                <a href="#collection" class="btn btn--gold">See the collection</a>
            </div>
            <div class="xmas-hero__visual">
                <div class="arch arch--gold">
                    <img src="{{ asset('images/products/xmas-iceberg-cheesecake.jpg') }}" alt="Christmas iceberg cheesecake among festive decorations" width="718" height="1076" fetchpriority="high">
                </div>
            </div>
        </div>
    </section>

    <section class="section xmas-section" id="collection">
        <div class="container">
            @if ($menus->isEmpty())
                <p class="empty-state">The Christmas collection will be announced soon.</p>
            @endif

            @if ($cakes->isNotEmpty())
                <div class="section-head section-head--center">
                    <p class="eyebrow eyebrow--center eyebrow--red">Whole cakes</p>
                    <h2 class="section-title">Festive cheesecakes</h2>
                    <p class="section-lead">Perfect for the family table or as a generous gift.</p>
                </div>
                <div class="product-grid">
                    @foreach ($cakes as $menu)
                        <x-product-card :menu="$menu" :show-category="false" />
                    @endforeach
                </div>
            @endif

            @if ($gifts->isNotEmpty())
                <div class="section-head section-head--center xmas-section__second">
                    <p class="eyebrow eyebrow--center eyebrow--red">Small gifts</p>
                    <h2 class="section-title">Boxes &amp; cups</h2>
                    <p class="section-lead">Sweet little presents for friends, colleagues and teachers.</p>
                </div>
                <div class="product-grid product-grid--three">
                    @foreach ($gifts as $menu)
                        <x-product-card :menu="$menu" :show-category="false" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="xmas-cta">
        <div class="container xmas-cta__inner">
            <h2>Planning gifts for the whole team?</h2>
            <p>Message us with the quantity and date. We'll help you put together the perfect set.</p>
            @if ($orderUrl = $contact->orderUrl('Hello Maison Céval, I would like to order from the Christmas collection.'))
                <a href="{{ $orderUrl }}" class="btn btn--gold" target="_blank" rel="noopener">Order via {{ $contact->orderChannel() }}</a>
            @endif
        </div>
    </section>

@endsection
