{{--
    One catalog card (photo with the catalog name). Used with:
        @include('layout.catalogcard', ['catalog' => $catalog])
--}}
@php
    $count = $catalog->countMenus();
@endphp
<a href="/catalog/{{ $catalog->slug }}" class="catalog-card" style="--accent: {{ $catalog->color }}" data-reveal> {{-- /catalog/everyday --}}
    <img src="/{{ $catalog->image }}" alt="" loading="lazy" width="900" height="1200">
    <div class="catalog-card__body"> 
        <span class="catalog-card__count">
            {{ $count }} {{ $count == 1 ? 'item' : 'items' }} {{-- keterangan jumlah item --}}
            @if ($catalog->is_seasonal) · Limited edition @endif
        </span>
        <h3 class="catalog-card__name">{{ $catalog->name }}</h3>
        <p>{{ $catalog->tagline }}</p>
        <span class="catalog-card__cta">Explore the catalog &rarr;</span>
    </div>
</a>
