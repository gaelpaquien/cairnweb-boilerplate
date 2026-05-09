import { initSmoothScroll } from './animations/smooth-scroll.js';
import { init as initNavbar } from './modules/navbar.js';
import { init as initContactForm } from './modules/contact-form.js';

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// Silence the "AbortError: Transition was skipped" noise from cross-document
// view transitions (meta[name=view-transition]) when a navigation interrupts
// an in-flight transition. The rejection is harmless but floods the console.
window.addEventListener('unhandledrejection', (event) => {
  const reason = event.reason;
  if (
    reason?.name === 'AbortError' &&
    typeof reason?.message === 'string' &&
    reason.message.includes('Transition was skipped')
  ) {
    event.preventDefault();
  }
});

// Navbar and contact form are always initialized (functional, not decorative)
initNavbar();
initContactForm();

if (!prefersReducedMotion) {
  initSmoothScroll();

  // Scroll reveals are lazy-loaded so ScrollTrigger's initial refresh runs
  // AFTER the browser's native hash-scroll has completed, avoiding the
  // refresh cycle fighting with scroll-to-anchor on cross-page navigation.
  import('./animations/scroll-reveals.js')
    .then((m) => m.initScrollReveals())
    .catch(() => {});

  // Hero entrance animation (lazy-loaded)
  import('./animations/hero-animation.js')
    .then((m) => m.init())
    .catch(() => {
      document.querySelectorAll('[data-hero-animate], [data-hero-visual]').forEach((el) => {
        el.style.opacity = '1';
        el.style.transform = 'none';
      });
    });
}
