/**
 * Promotions Carousel — Infinite one-direction scroll
 *
 * Cards are cloned and appended to create a seamless loop.
 * When the scroll passes the original cards, it resets
 * to the beginning instantly (no visual jump).
 */
document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('promoTrack');
    if (!track) return;

    // ── Clone cards for seamless infinite scroll ──
    const originalCards = Array.from(track.querySelectorAll('.promo-card'));
    originalCards.forEach((card) => {
        const clone = card.cloneNode(true);
        clone.setAttribute('aria-hidden', 'true'); // accessibility: hide clones
        track.appendChild(clone);
    });

    // ── Constants ──
    const AUTO_SCROLL_SPEED = 0.8;          // px per frame (lower = slower)
    const AUTO_SCROLL_RESUME_DELAY = 2000;  // ms to wait after interaction
    let animationId = null;
    let isPaused = false;
    let resumeTimeout = null;

    // The scroll boundary: total width of the original cards
    function getResetPoint() {
        let width = 0;
        for (let i = 0; i < originalCards.length; i++) {
            width += originalCards[i].offsetWidth + 16; // 16px = margin-right
        }
        return width;
    }

    // ── Animation loop (requestAnimationFrame) ──
    function step() {
        if (!isPaused) {
            track.scrollLeft += AUTO_SCROLL_SPEED;

            // When we've scrolled past all original cards, jump back
            const resetPoint = getResetPoint();
            if (track.scrollLeft >= resetPoint) {
                track.scrollLeft -= resetPoint;
            }
        }
        animationId = requestAnimationFrame(step);
    }

    function startAnimation() {
        if (animationId) return; // already running
        animationId = requestAnimationFrame(step);
    }

    function pause() {
        isPaused = true;
        clearTimeout(resumeTimeout);
    }

    function resumeAfterDelay() {
        clearTimeout(resumeTimeout);
        resumeTimeout = setTimeout(() => {
            isPaused = false;
        }, AUTO_SCROLL_RESUME_DELAY);
    }

    // ── Pause on hover ──
    track.addEventListener('mouseenter', pause);
    track.addEventListener('mouseleave', resumeAfterDelay);

    // ── Drag to scroll ──
    let isDown = false, startX, scrollLeft;

    track.addEventListener('mousedown', (e) => {
        isDown = true;
        pause();
        track.classList.add('is-dragging');
        startX = e.pageX - track.offsetLeft;
        scrollLeft = track.scrollLeft;
    });

    const stopDrag = () => {
        if (!isDown) return;
        isDown = false;
        track.classList.remove('is-dragging');
        resumeAfterDelay();
    };

    track.addEventListener('mouseleave', stopDrag);
    track.addEventListener('mouseup', stopDrag);

    track.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - track.offsetLeft;
        const walk = (x - startX) * 1.5;
        track.scrollLeft = scrollLeft - walk;
    });

    // ── Pause on touch (mobile) ──
    track.addEventListener('touchstart', pause, { passive: true });
    track.addEventListener('touchend', resumeAfterDelay);

    // ── Start ──
    startAnimation();
});
