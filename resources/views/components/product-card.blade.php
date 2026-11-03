@props(['menu', 'showCatalog' => true])

{{--
    Product card. Every card has the same size: fixed photo shape, name area
    of two lines, description area of three lines, and the price at the bottom.
--}}
<article {{ $attributes->class(['product-card']) }} style="--accent: {{ $menu->accent }}" data-reveal>
    <a href="{{ route('menu.show', $menu) }}" class="product-card__link">
        <div class="product-card__media">
            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" loading="lazy" width="600" height="600">
            @if ($showCatalog && $menu->is_seasonal)
                <span class="product-card__badge">{{ $menu->catalog->name }}</span>
            @endif
        </div>

        <div class="product-card__body">
            <p class="product-card__category">{{ $menu->category->name ?? 'Maison Céval' }}</p>
            <h3 class="product-card__name">{{ $menu->display_name }}</h3>
            <p class="product-card__desc">{{ $menu->description }}</p>

            <div class="product-card__foot">
                <span class="product-card__price">{{ $menu->price_label }}</span>
                <span class="product-card__more" aria-hidden="true">Details &rarr;</span>
            </div>
        </div>
    </a>
</article>
