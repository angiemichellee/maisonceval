// Maison Céval: small progressive enhancements (the site works without JS).
(function () {
    var root = document.documentElement;

    // Mobile navigation
    var toggle = document.querySelector('[data-nav-toggle]');
    if (toggle) {
        toggle.addEventListener('click', function () {
            var open = root.classList.toggle('nav-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
        // Close the mobile menu after a link is tapped (e.g. "Catalog" or "Order now").
        document.querySelectorAll('#site-nav a').forEach(function (link) {
            link.addEventListener('click', function () {
                root.classList.remove('nav-open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && root.classList.contains('nav-open')) {
                root.classList.remove('nav-open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.focus();
            }
        });
    }

    // Header shadow once the page scrolls
    var header = document.querySelector('[data-header]');
    if (header) {
        var onScroll = function () { header.classList.toggle('is-scrolled', window.scrollY > 8); };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    // Fade elements in as they enter the viewport
    var items = document.querySelectorAll('[data-reveal]');
    if (!('IntersectionObserver' in window)) {
        items.forEach(function (el) { el.classList.add('is-visible'); });
        return;
    }
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
    items.forEach(function (el, i) {
        el.style.transitionDelay = (i % 4) * 70 + 'ms';
        observer.observe(el);
    });
})();
