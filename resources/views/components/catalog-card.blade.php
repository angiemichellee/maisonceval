@props(['catalog', 'size' => 'large'])

{{-- A catalog (Everyday Menu, Christmas Collection, ...) as a photo card. --}}
<a href="{{ route('catalog.show', $catalog) }}"
   {{ $attributes->class(['catalog-card', 'catalog-card--small' => $size === 'small']) }}
   style="--accent: {{ $catalog->accent }}" data-reveal>
    <img src="{{ $catalog->image_url }}" alt="" loading="lazy" width="900" height="1200">
    <div class="catalog-card__body">
        <span class="catalog-card__count">
            {{ $catalog->menus_count }} {{ Str::plural('item', $catalog->menus_count) }}
            @if ($catalog->is_seasonal) · Limited edition @endif
        </span>
        <h3 class="catalog-card__name">{{ $catalog->name }}</h3>
        @if ($catalog->tagline)
            <p>{{ $catalog->tagline }}</p>
        @endif
        <span class="catalog-card__cta">Explore the catalog &rarr;</span>
    </div>
</a>
