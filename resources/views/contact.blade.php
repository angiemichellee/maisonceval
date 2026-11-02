@extends('layouts.app')

@section('title', 'Contact & Order · Maison Céval')
@section('description', 'Order cakes from Maison Céval. Find us on Instagram, WhatsApp or email.')

@section('content')

    <section class="page-hero">
        <div class="container">
            <p class="eyebrow eyebrow--center">Contact</p>
            <h1 class="page-hero__title">Let's make it special</h1>
            <p class="page-hero__lead">
                For orders, gifting and celebrations, send us a message. We'd love to bake for you.
            </p>
        </div>
    </section>

    <section class="section section--flush-top">
        <div class="container contact-grid">
            @if ($contact->whatsapp_number)
                <a href="{{ $contact->orderUrl() }}" class="contact-card contact-card--primary" target="_blank" rel="noopener" data-reveal>
                    <span class="contact-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2Zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2Zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1l-.8 1c-.1.2-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.2-.4.7-1.4.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.7 11.8 11.8 0 0 0 4.5 4c1.7.7 2.3.8 3.2.6a2.7 2.7 0 0 0 1.8-1.2 2.2 2.2 0 0 0 .1-1.3c0-.1-.2-.2-.4-.3Z"/></svg>
                    </span>
                    <span class="contact-card__label">WhatsApp</span>
                    <span class="contact-card__value">{{ $contact->whatsapp ?: $contact->phoneNumber }}</span>
                    <span class="contact-card__hint">Fastest way to order &rarr;</span>
                </a>
            @endif

            @if ($contact->instagram_url)
                <a href="{{ $contact->instagram_url }}" class="contact-card {{ $contact->whatsapp_number ? '' : 'contact-card--primary' }}" target="_blank" rel="noopener" data-reveal>
                    <span class="contact-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M12 7.3A4.7 4.7 0 1 0 16.7 12 4.7 4.7 0 0 0 12 7.3Zm0 7.7a3 3 0 1 1 3-3 3 3 0 0 1-3 3Zm6-7.9a1.1 1.1 0 1 1-1.1-1.1A1.1 1.1 0 0 1 18 7.1ZM21.9 8a5.5 5.5 0 0 0-1.5-3.9A5.5 5.5 0 0 0 16.5 2.6C15 2.5 9 2.5 7.5 2.6a5.5 5.5 0 0 0-3.9 1.5A5.5 5.5 0 0 0 2.1 8c-.1 1.5-.1 6.5 0 8a5.5 5.5 0 0 0 1.5 3.9 5.5 5.5 0 0 0 3.9 1.5c1.5.1 7.5.1 9 0a5.5 5.5 0 0 0 3.9-1.5 5.5 5.5 0 0 0 1.5-3.9c.1-1.5.1-6.5 0-8Zm-2 9.7a3.2 3.2 0 0 1-1.8 1.8c-1.3.5-4.3.4-5.1.4s-3.9.1-5.1-.4a3.2 3.2 0 0 1-1.8-1.8c-.5-1.3-.4-4.3-.4-5.7s-.1-4.4.4-5.7a3.2 3.2 0 0 1 1.8-1.8c1.3-.5 4.3-.4 5.1-.4s3.9-.1 5.1.4a3.2 3.2 0 0 1 1.8 1.8c.5 1.3.4 4.3.4 5.7s.1 4.4-.4 5.7Z"/></svg>
                    </span>
                    <span class="contact-card__label">Instagram</span>
                    <span class="contact-card__value">{{ '@'.$contact->instagram_handle }}</span>
                    <span class="contact-card__hint">See our latest bakes &rarr;</span>
                </a>
            @endif

            @if ($contact->email)
                <a href="mailto:{{ $contact->email }}" class="contact-card" data-reveal>
                    <span class="contact-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 2v.5l-8 5-8-5V6Zm0 12H4V8.8l7.5 4.7a1 1 0 0 0 1 0L20 8.8Z"/></svg>
                    </span>
                    <span class="contact-card__label">Email</span>
                    <span class="contact-card__value">{{ $contact->email }}</span>
                    <span class="contact-card__hint">For events &amp; corporate gifts &rarr;</span>
                </a>
            @endif
        </div>

        @if ($contact->address || $contact->opening_hours)
            <div class="container contact-details" data-reveal>
                @if ($contact->address)
                    <div><h2>Find us</h2><p>{{ $contact->address }}</p></div>
                @endif
                @if ($contact->opening_hours)
                    <div><h2>Opening hours</h2><p>{{ $contact->opening_hours }}</p></div>
                @endif
            </div>
        @endif
    </section>

    @include('partials.how-to-order')

@endsection
