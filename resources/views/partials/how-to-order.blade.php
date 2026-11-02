<section class="section order-steps">
    <div class="container">
        <div class="section-head section-head--center">
            <p class="eyebrow eyebrow--center">Ordering</p>
            <h2 class="section-title">How to order</h2>
            <p class="section-lead">Everything is baked to order, so we ask you to order ahead.</p>
        </div>

        <ol class="steps">
            <li class="step" data-reveal>
                <span class="step__num">01</span>
                <h3>Choose your cake</h3>
                <p>Browse the everyday menu or the Christmas collection and pick your flavours.</p>
            </li>
            <li class="step" data-reveal>
                <span class="step__num">02</span>
                <h3>Send us a message</h3>
                <p>Tell us what you'd like, how many, and the date you need it via {{ $contact->orderChannel() }}.</p>
            </li>
            <li class="step" data-reveal>
                <span class="step__num">03</span>
                <h3>We bake it for you</h3>
                <p>We confirm your order and prepare it fresh, beautifully boxed and ready to enjoy or give.</p>
            </li>
        </ol>

        @if ($orderUrl = $contact->orderUrl())
            <div class="order-steps__cta">
                <a href="{{ $orderUrl }}" class="btn" target="_blank" rel="noopener">Order via {{ $contact->orderChannel() }}</a>
            </div>
        @endif
    </div>
</section>
