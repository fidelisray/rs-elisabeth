/**
 * Ruang Perawatan Page — JS
 * Handles tab filter for room categories (show all / premium / standard)
 */

document.addEventListener('DOMContentLoaded', () => {

    /* ---- Room Filter Tabs ---- */
    const filterBtns = document.querySelectorAll('[data-room-filter]');
    const premiumSection  = document.getElementById('premium-rooms');
    const standardSection = document.getElementById('standard-rooms');
    const comparisonSection = document.getElementById('room-comparison');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.getAttribute('data-room-filter');

            if (filter === 'all') {
                premiumSection.style.display  = '';
                standardSection.style.display = '';
                comparisonSection.style.display = '';
            } else if (filter === 'premium') {
                premiumSection.style.display  = '';
                standardSection.style.display = 'none';
                comparisonSection.style.display = '';
            } else if (filter === 'standard') {
                premiumSection.style.display  = 'none';
                standardSection.style.display = '';
                comparisonSection.style.display = '';
            }
        });
    });

    /* ---- Scroll reveal animation ---- */
    const revealItems = document.querySelectorAll('.reveal-on-scroll');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealItems.forEach(el => observer.observe(el));
    } else {
        // Fallback: show all immediately
        revealItems.forEach(el => el.classList.add('revealed'));
    }
});
