{{-- Footer with the contact details. $contact comes from the controller (Contact::current()) --}}
<footer class="site-footer" id="contact">
    <div class="container site-footer__grid">
        <div class="site-footer__brand">
            <img src="/images/logo-light.png" alt="Maison Céval, Pure Taste. Pure Class." width="584" height="613" class="site-footer__logo">
            <p>Cake shop since 2020. Every cake is baked to order with care, quality and an eye for detail.</p>
        </div>

        <div>
            <h2 class="site-footer__title">Explore</h2>
            <ul class="site-footer__links">
                <li><a href="/">Home</a></li>
                <li><a href="/#catalogs">Catalog</a></li>
                <li><a href="/menu">Menu</a></li>
                <li><a href="#ordering">How to Order</a></li>
            </ul>
        </div>

        <div>
            <h2 class="site-footer__title">Get in touch</h2>
            <ul class="site-footer__links">
                @if ($contact->instagram)
                    <li><a href="{{ $contact->instagramUrl() }}" target="_blank" rel="noopener">Instagram · {{ '@' . $contact->instagram }}</a></li>
                @endif
                @if ($contact->whatsapp)
                    <li><a href="{{ $contact->orderUrl() }}" target="_blank" rel="noopener">WhatsApp · {{ $contact->whatsapp }}</a></li>
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
