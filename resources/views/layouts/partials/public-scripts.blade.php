<script>
(function () {
    'use strict';

    /* ---------- Navigasi Menu Multi-Dropdown ---------- */
    var header = document.getElementById('siteHeader');
    if (header) {
        var toggle = header.querySelector('.nav-toggle');
        var drops = header.querySelectorAll('.has-drop');
        var subs = header.querySelectorAll('.has-sub');
        var desktop = window.matchMedia('(hover: hover) and (min-width: 1201px)');

        function triggerOf(li) {
            return li.querySelector(':scope > .menu-trigger, :scope > .menu-trigger-cta');
        }

        function closeSubs() {
            subs.forEach(function (s) {
                s.classList.remove('open');
                var st = s.querySelector('.sub-trigger');
                if (st) st.setAttribute('aria-expanded', 'false');
            });
        }

        function closeDrops(except) {
            drops.forEach(function (li) {
                if (li !== except) {
                    li.classList.remove('open');
                    var tr = triggerOf(li);
                    if (tr) tr.setAttribute('aria-expanded', 'false');
                }
            });
            if (!except) closeSubs();
        }

        function setMobileMenu(open) {
            header.classList.toggle('nav-open', open);
            document.body.classList.toggle('nav-lock', open);
            if (toggle) {
                toggle.setAttribute('aria-expanded', open);
                toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
                var icon = toggle.querySelector('i');
                if (icon) icon.className = open ? 'fas fa-times' : 'fas fa-bars';
            }
            if (!open) closeDrops(null);
        }

        if (toggle) {
            toggle.addEventListener('click', function () {
                setMobileMenu(!header.classList.contains('nav-open'));
            });
        }

        drops.forEach(function (li) {
            var btn = triggerOf(li);
            if (btn) {
                btn.addEventListener('click', function () {
                    var open = li.classList.toggle('open');
                    btn.setAttribute('aria-expanded', open);
                    closeDrops(li);
                });
            }
            
            li.addEventListener('mouseleave', function () {
                if (!desktop.matches) return;
                li.classList.remove('open');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                closeSubs();
            });
        });

        subs.forEach(function (li) {
            var btn = li.querySelector('.sub-trigger');
            if (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var open = li.classList.toggle('open');
                    btn.setAttribute('aria-expanded', open);
                });
            }
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.has-drop')) closeDrops(null);
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeDrops(null);
                if (header.classList.contains('nav-open')) setMobileMenu(false);
            }
        });

        window.matchMedia('(min-width: 1201px)').addEventListener('change', function (e) {
            if (e.matches) setMobileMenu(false);
        });
    }

    /* ---------- Tombol lapor mengambang ---------- */
    var fab = document.getElementById('sosFab');
    if (fab) {
        var fabBtn = fab.querySelector('.sos-fab-btn');

        function updateFab() {
            var show = window.scrollY > 320;
            fab.classList.toggle('show', show);
            if (!show) { 
                fab.classList.remove('open'); 
                if (fabBtn) fabBtn.setAttribute('aria-expanded', 'false'); 
            }
        }
        window.addEventListener('scroll', updateFab, { passive: true });
        updateFab();

        if (fabBtn) {
            fabBtn.addEventListener('click', function () {
                var open = fab.classList.toggle('open');
                fabBtn.setAttribute('aria-expanded', open);
            });
        }

        function closeFab() {
            fab.classList.remove('open');
            if (fabBtn) fabBtn.setAttribute('aria-expanded', 'false');
        }
        document.addEventListener('click', function (e) {
            if (!e.target.closest('#sosFab')) closeFab();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeFab();
        });
    }
})();
</script>
