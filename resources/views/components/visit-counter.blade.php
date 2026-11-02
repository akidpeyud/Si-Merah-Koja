@props([
    'page' => 'simerahkoja',
    'track' => true,
    'title' => 'Statistik Pengunjung',
])

@inject('visitService', 'App\Services\VisitCounter')

@php
    try {
        $stats = $visitService->getStats($page);
    } catch (\Throwable $e) {
        $stats = [
            'today' => 0,
            'this_week' => 0,
            'this_month' => 0,
            'all_time' => 0,
        ];
    }
@endphp

@once
<style>
    .visit-stats-widget {
        display: flex;
        flex-direction: column;
    }

    .visit-stats-title {
        font-family: var(--font-display, 'Bricolage Grotesque', system-ui, sans-serif);
        font-weight: 700;
        font-size: 1.15rem;
        color: #ffffff;
        margin-bottom: 16px;
    }

    .visit-stats-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .visit-stats-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        font-family: var(--font-body, 'Instrument Sans', system-ui, sans-serif);
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.85);
    }

    .visit-stats-label {
        font-weight: 500;
        white-space: nowrap;
    }

    .visit-stats-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 68px;
        padding: 4px 14px;
        border-radius: 9999px;
        background: #e2e8f0;
        color: #0f172a;
        font-family: var(--font-body, 'Instrument Sans', system-ui, sans-serif);
        font-size: 0.88rem;
        font-weight: 700;
        line-height: 1.25;
        font-variant-numeric: tabular-nums;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s ease, opacity 0.25s ease;
    }

    .visit-stats-badge:hover {
        transform: translateY(-1px);
    }

    @media (max-width: 640px) {
        .visit-stats-list {
            gap: 10px;
        }

        .visit-stats-item {
            font-size: 0.9rem;
        }

        .visit-stats-badge {
            min-width: 60px;
            padding: 3px 12px;
            font-size: 0.82rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .visit-stats-badge {
            transition: none !important;
        }
    }
</style>
@endonce

<div
    {{ $attributes->merge(['class' => 'visit-stats-widget']) }}
    data-visit-counter
    data-page="{{ $page }}"
    data-track="{{ $track ? 'true' : 'false' }}"
    role="region"
    aria-label="Statistik Pengunjung"
>
    @if ($title)
        <h3 class="visit-stats-title">{{ $title }}</h3>
    @endif

    <ul class="visit-stats-list">
        <li class="visit-stats-item">
            <span class="visit-stats-label">Hari ini</span>
            <span class="visit-stats-badge" data-visit-today>{{ number_format($stats['today'], 0, ',', '.') }}</span>
        </li>
        <li class="visit-stats-item">
            <span class="visit-stats-label">Minggu ini</span>
            <span class="visit-stats-badge" data-visit-week>{{ number_format($stats['this_week'], 0, ',', '.') }}</span>
        </li>
        <li class="visit-stats-item">
            <span class="visit-stats-label">Bulan ini</span>
            <span class="visit-stats-badge" data-visit-month>{{ number_format($stats['this_month'], 0, ',', '.') }}</span>
        </li>
        <li class="visit-stats-item">
            <span class="visit-stats-label">Semua</span>
            <span class="visit-stats-badge" data-visit-all>{{ number_format($stats['all_time'], 0, ',', '.') }}</span>
        </li>
    </ul>
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
            if (!el) return;
            var currentText = (el.textContent || '').replace(/[^\d]/g, '');
            var startValue = parseInt(currentText, 10);
            if (isNaN(startValue)) startValue = 0;

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
                var current = Math.round(startValue + (target - startValue) * eased);
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

            var todayEl = container.querySelector('[data-visit-today]');
            var weekEl = container.querySelector('[data-visit-week]');
            var monthEl = container.querySelector('[data-visit-month]');
            var allEl = container.querySelector('[data-visit-all]');

            var endpoint = '/api/visits/' + encodeURIComponent(page) + '?stats=1';
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
                    if (!data) return;

                    if (data.stats) {
                        if (typeof data.stats.today === 'number') {
                            animateValue(todayEl, data.stats.today);
                        }
                        if (typeof data.stats.this_week === 'number') {
                            animateValue(weekEl, data.stats.this_week);
                        }
                        if (typeof data.stats.this_month === 'number') {
                            animateValue(monthEl, data.stats.this_month);
                        }
                        if (typeof data.stats.all_time === 'number') {
                            animateValue(allEl, data.stats.all_time);
                        }
                    } else if (typeof data.total === 'number') {
                        animateValue(monthEl, data.total);
                    }
                })
                .catch(function () {
                    // Biarkan nilai server-rendered tetap tampil jika request gagal
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