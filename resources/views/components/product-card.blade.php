@props(['menu', 'showCategory' => true])

<article {{ $attributes->class(['product-card', 'product-card--festive' => $menu->is_christmas]) }} data-reveal>
    <a href="{{ route('menu.show', $menu) }}" class="product-card__link">
        <div class="product-card__media">
            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" loading="lazy" width="600" height="750">
            @if ($menu->is_christmas)
                <span class="product-card__badge">Christmas</span>
            @endif
        </div>

        <div class="product-card__body">
            @if ($showCategory && $menu->category)
                <p class="product-card__category">{{ $menu->category->name }}</p>
            @endif
            <h3 class="product-card__name">{{ $menu->display_name }}</h3>
            <p class="product-card__desc">{{ $menu->description }}</p>

            <div class="product-card__foot">
                <span class="product-card__price">{{ $menu->price_label }}</span>
                <span class="product-card__more" aria-hidden="true">View &rarr;</span>
            </div>
        </div>
    </a>
</article>
