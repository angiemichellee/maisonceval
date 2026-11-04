{{--
    One product card. Used with:
        @include('layout.productcard', ['menu' => $menu])
    $catalogs and $categories come from the controller.
    Every card has the same size (see .product-card in maison.css).
--}}
@php
    $menuCatalog = $catalogs->firstWhere('id', $menu->catalog_id);
    $menuCategory = $categories->firstWhere('id', $menu->category_id);
@endphp
<article class="product-card" style="--accent: {{ $menuCatalog->color }}" data-reveal>
    <a href="/menu/{{ $menu->slug }}" class="product-card__link">
        <div class="product-card__media">
            <img src="/{{ $menu->image }}" alt="{{ $menu->name }}" loading="lazy" width="600" height="600">
        </div>

        <div class="product-card__body">
            <p class="product-card__category">{{ $menuCategory->name }}</p>
            <h3 class="product-card__name">{{ $menu->name }}</h3>
            <p class="product-card__desc">{{ $menu->description }}</p>

            <div class="product-card__foot">
                <span class="product-card__price">{{ $menu->priceLabel() }}</span>
                <span class="product-card__more" aria-hidden="true">Details &rarr;</span>
            </div>
        </div>
    </a>
</article>
