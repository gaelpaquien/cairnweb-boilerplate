import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const DEFAULTS = {
  duration: 0.6,
  delay: 0,
  stagger: 0.1,
  yOffset: 40,
  ease: 'power2.out',
  scrollStart: 'top 95%',
};

function parseAttr(value, fallback) {
  const n = parseFloat(value);
  return isNaN(n) ? fallback : n;
}

function applyWillChange(el) {
  el.style.willChange = 'transform, opacity';
}

function removeWillChange(el) {
  el.style.willChange = '';
}

function initFadeUp() {
  document.querySelectorAll('[data-gsap="fade-up"]').forEach((el) => {
    const duration = parseAttr(el.dataset.gsapDuration, DEFAULTS.duration);
    const delay = parseAttr(el.dataset.gsapDelay, DEFAULTS.delay);

    gsap.fromTo(
      el,
      { opacity: 0, y: DEFAULTS.yOffset },
      {
        opacity: 1,
        y: 0,
        duration,
        delay,
        ease: DEFAULTS.ease,
        scrollTrigger: {
          trigger: el,
          start: DEFAULTS.scrollStart,
          once: true,
        },
        onStart() { applyWillChange(el); },
        onComplete() { removeWillChange(el); },
      }
    );
  });
}

function initBatch() {
  document.querySelectorAll('[data-gsap="batch"]').forEach((container) => {
    const children = Array.from(container.children);
    if (!children.length) return;

    container.style.opacity = '1';

    const duration = parseAttr(container.dataset.gsapDuration, DEFAULTS.duration);

    gsap.set(children, { opacity: 0, y: DEFAULTS.yOffset });

    ScrollTrigger.batch(children, {
      start: DEFAULTS.scrollStart,
      once: true,
      onEnter(batch) {
        batch.forEach((el) => {
          applyWillChange(el);
          el.style.transition = 'none';
        });
        gsap.to(batch, {
          opacity: 1,
          y: 0,
          duration,
          ease: DEFAULTS.ease,
          onComplete() {
            batch.forEach((el) => {
              removeWillChange(el);
              el.style.transition = '';
            });
          },
        });
      },
    });
  });
}

export function initScrollReveals() {
  initFadeUp();
  initBatch();
}
