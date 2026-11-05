@extends('layout.mainlayout')

@section('title', $title)

@section('content')

    @php
        $message = 'Hello Maison Céval, I would like to order the ' . $menu->name . ' (' . $menu->priceLabel() . ').';
    @endphp

    <section class="product {{ $catalog->is_seasonal ? 'product--seasonal' : '' }}"> {{-- cek kl seasonal ga --}}
        <div class="container">
            <div class="product__grid" style="--accent: {{ $catalog->color }}">
                <div class="product__media">
                    <div class="arch {{ $catalog->is_seasonal ? 'arch--gold' : '' }}">
                        <img src="/{{ $menu->image }}" alt="{{ $menu->name }}" width="900" height="1200">
                    </div>
                </div>

                <div class="product__info">
                    <p class="eyebrow">{{ $catalog->name }} · {{ $category->name }}</p>
                    <h1 class="product__name">{{ $menu->name }}</h1>
                    <p class="product__price">{{ $menu->priceLabel() }}</p>

                    <p class="product__desc">{{ $menu->description }}</p>

                    {{-- kalo ada variant --}}
                    @if (count($menu->variantList()) > 0)
                        <div class="product__block">
                            <h2 class="product__label">{{ count($menu->variantList()) > 1 ? 'Choose a flavour' : 'Flavour' }}</h2>
                            <ul class="variant-list">
                                @foreach ($menu->variantList() as $variant)
                                    <li class="variant">
                                        <span>{{ $variant['name'] }}</span>
                                        @isset($variant['price'])
                                            <strong>Rp {{ number_format($variant['price'], 0, ',', '.') }}</strong>
                                        @endisset
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {{-- kl ada includesnya --}}
                    @if ($menu->includes)
                        <div class="product__block product__includes">
                            <h2 class="product__label">Includes</h2>
                            <p><span aria-hidden="true">&#10022;</span> {{ $menu->includes }}</p>
                        </div>
                    @endif


                    {{-- button WA sm back ke catalog --}}
                    <div class="product__actions">
                        <a href="{{ $contact->orderUrl($message) }}" class="btn {{ $catalog->is_seasonal ? 'btn--accent' : '' }}" target="_blank" rel="noopener">
                            Order via {{ $contact->orderChannel() }}
                        </a>
                        <a href="/catalog/{{ $catalog->slug }}" class="btn btn--ghost">Back to catalog</a>
                    </div>

                    <p class="product__note">Baked to order. Please order ahead and tell us the date you need it.</p>
                </div>
            </div>
        </div>
    </section>


    {{-- ============ YOU MAY ALSO LIKE ============ --}}
    @if ($related->isNotEmpty())
        <section class="section section--tint">
            <div class="container">
                <div class="section-head">
                    <div>
                        <p class="eyebrow">You may also like</p>
                        <h2 class="section-title">More from {{ $catalog->name }}</h2>
                    </div>
                </div>
                <div class="product-grid">
                    @foreach ($related as $item)
                        @include('layout.productcard', ['menu' => $item])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
