@props([
    'page' => 'simerahkoja',
    'track' => true,
])

@once
<style>
    .visit-counter {
        position: absolute;
        left: max(clamp(16px, 4vw, 32px), calc((100% - var(--wrap, 1300px)) / 2 + clamp(16px, 4vw, 32px)));
        bottom: 28px;
        z-index: 4;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 9999px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        color: #ffffff;
        font-family: var(--font-body, 'Instrument Sans', system-ui, sans-serif);
        font-size: 13.5px;
        line-height: 1.2;
        letter-spacing: 0.01em;
        box-shadow: 0 8px 24px -8px rgba(0, 0, 0, 0.35);
        user-select: none;
        pointer-events: auto;
        transition: opacity 0.25s ease, transform 0.25s ease, border-color 0.25s ease;
    }

    .hero:has(.ticker) .visit-counter {
        bottom: 72px;
    }

    .visit-counter:hover {
        border-color: rgba(255, 255, 255, 0.28);
    }

    .visit-counter__icon {
        width: 15px;
        height: 15px;
        flex: none;
        color: var(--amber, #ffb627);
        opacity: 0.95;
    }

    .visit-counter__text {
        display: inline-flex;
        align-items: baseline;
        gap: 5px;
        color: rgba(255, 255, 255, 0.88);
        white-space: nowrap;
    }

    .visit-counter__value {
        font-weight: 700;
        color: #ffffff;
        font-variant-numeric: tabular-nums;
        display: inline-block;
        transition: opacity 0.25s ease;
    }

    @media (max-width: 640px) {
        .visit-counter {
            bottom: 24px;
            padding: 6px 13px;
            font-size: 12.5px;
            gap: 6px;
        }

        .hero:has(.ticker) .visit-counter {
            bottom: 64px;
        }

        .visit-counter__icon {
            width: 14px;
            height: 14px;
        }
    }

    @media (max-width: 380px) {
        .visit-counter {
            padding: 6px 11px;
            font-size: 12px;
        }

        .visit-counter__label {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .visit-counter,
        .visit-counter__value {
            transition: none !important;
        }
    }
</style>
@endonce

<div
    {{ $attributes->merge(['class' => 'visit-counter']) }}
    data-visit-counter
    data-page="{{ $page }}"
    data-track="{{ $track ? 'true' : 'false' }}"
    role="status"
    aria-label="Total kunjungan halaman bulan ini"
>
    <svg class="visit-counter__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
        <circle cx="12" cy="12" r="3"/>
    </svg>
    <span class="visit-counter__text">
        <span class="visit-counter__label">Kunjungan bulan ini:</span>
        <b class="visit-counter__value" data-visit-value aria-live="polite">...</b>
    </span>
</div>

@once
<script>
(function () {
    function initVisitCounters() {
        var counters = document.querySelectorAll('[data-visit-counter]');
        if (!counters.length) return;

        var reducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var csrfMeta = document.querySelector('meta[name="csrf-token"]');
        var csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

        function animateValue(el, target) {
            if (reducedMotion || target <= 0 || typeof window.requestAnimationFrame !== 'function') {
                el.textContent = target.toLocaleString('id-ID');
                return;
            }

            var duration = 520;
            var startTime = null;

            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                var progress = Math.min((timestamp - startTime) / duration, 1);
                var eased = 1 - Math.pow(1 - progress, 3);
                var current = Math.round(eased * target);
                el.textContent = current.toLocaleString('id-ID');

                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    el.textContent = target.toLocaleString('id-ID');
                }
            }

            window.requestAnimationFrame(step);
        }

        counters.forEach(function (container) {
            if (container.getAttribute('data-visit-initialized') === '1') return;
            container.setAttribute('data-visit-initialized', '1');

            var page = container.getAttribute('data-page') || 'simerahkoja';
            var shouldTrack = container.getAttribute('data-track') !== 'false';
            var valueEl = container.querySelector('[data-visit-value]');
            if (!valueEl) return;

            var endpoint = '/api/visits/' + encodeURIComponent(page);
            var options = {
                method: shouldTrack ? 'POST' : 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin',
                cache: 'no-store'
            };

            if (shouldTrack && csrfToken) {
                options.headers['X-CSRF-TOKEN'] = csrfToken;
            }

            fetch(endpoint, options)
                .then(function (res) {
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    return res.json();
                })
                .then(function (data) {
                    if (data && typeof data.total === 'number' && isFinite(data.total)) {
                        animateValue(valueEl, data.total);
                    } else {
                        valueEl.textContent = '-';
                    }
                })
                .catch(function () {
                    valueEl.textContent = '-';
                });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initVisitCounters);
    } else {
        initVisitCounters();
    }
})();
</script>
@endonce
