<footer class="site-footer">
    <div class="container site-footer__grid">
        <div class="site-footer__brand">
            <img src="{{ asset('images/logo-light.png') }}" alt="Maison Céval, Pure Taste. Pure Class." width="584" height="613" class="site-footer__logo">
            <p>Cake shop since 2020. Every cake is baked to order with care, quality and an eye for detail.</p>
        </div>

        <div>
            <h2 class="site-footer__title">Explore</h2>
            <ul class="site-footer__links">
                <li><a href="{{ route('menu') }}">Everyday Menu</a></li>
                <li><a href="{{ route('christmas') }}">Christmas Collection</a></li>
                <li><a href="{{ route('category') }}">Categories</a></li>
                <li><a href="{{ route('contact') }}">How to Order</a></li>
            </ul>
        </div>

        <div>
            <h2 class="site-footer__title">Get in touch</h2>
            <ul class="site-footer__links">
                @if ($contact->instagram_url)
                    <li><a href="{{ $contact->instagram_url }}" target="_blank" rel="noopener">Instagram · {{ '@'.$contact->instagram_handle }}</a></li>
                @endif
                @if ($contact->whatsapp_number)
                    <li><a href="{{ $contact->orderUrl() }}" target="_blank" rel="noopener">WhatsApp · {{ $contact->whatsapp ?: $contact->phoneNumber }}</a></li>
                @endif
                @if ($contact->email)
                    <li><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></li>
                @endif
                @if ($contact->address)
                    <li class="site-footer__muted">{{ $contact->address }}</li>
                @endif
                @if ($contact->opening_hours)
                    <li class="site-footer__muted">{{ $contact->opening_hours }}</li>
                @endif
            </ul>
        </div>
    </div>

    <div class="container site-footer__bottom">
        <span>&copy; {{ date('Y') }} Maison Céval. All rights reserved.</span>
        <span>Pure Taste. Pure Class.</span>
    </div>
</footer>
