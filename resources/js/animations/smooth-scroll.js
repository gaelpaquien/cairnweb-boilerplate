import Lenis from 'lenis';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initSmoothScroll() {
  const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    orientation: 'vertical',
    smoothWheel: true,
  });

  lenis.on('scroll', ScrollTrigger.update);

  gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
  });
  gsap.ticker.lagSmoothing(0);

  function scrollToHash(hash, immediate = false) {
    if (!hash || hash === '#') return false;
    const target = document.querySelector(hash);
    if (!target) return false;
    lenis.scrollTo(target, { offset: 0, immediate });
    return true;
  }

  document.querySelectorAll('a[href^="#"], a[href*="/#"]').forEach((anchor) => {
    const href = anchor.getAttribute('href');
    if (!href) return;
    const hashIndex = href.indexOf('#');
    if (hashIndex === -1) return;
    const hash = href.slice(hashIndex);
    const path = href.slice(0, hashIndex);
    const samePagePath = path === '' || path === window.location.pathname;
    if (!samePagePath) return;

    anchor.addEventListener('click', (e) => {
      if (scrollToHash(hash)) {
        e.preventDefault();
        if (window.history && window.history.replaceState) {
          window.history.replaceState(null, '', hash);
        }
      }
    });
  });

  if (window.location.hash) {
    const hash = window.location.hash;
    window.history.scrollRestoration = 'manual';
    window.scrollTo(0, 0);
    setTimeout(() => scrollToHash(hash, true), 100);
  }
}
