import { qs, qsa } from '../utils/dom.js';

const SCROLL_THRESHOLD = 50;
let lastScrollY = 0;

function handleScroll() {
  const nav = qs('[data-nav]');
  if (!nav) return;

  const y = window.scrollY;
  const goingDown = y > lastScrollY;
  lastScrollY = y;

  if (goingDown && y > 1) {
    nav.setAttribute('data-scrolled', '');
  } else if (!goingDown && y < SCROLL_THRESHOLD) {
    nav.removeAttribute('data-scrolled');
  }

  const navBottom = nav.getBoundingClientRect().bottom + 2;
  const sections = qsa('[data-section-theme]');
  let overLight = false;

  for (const section of sections) {
    const rect = section.getBoundingClientRect();
    if (rect.top < navBottom && rect.bottom > navBottom) {
      overLight = section.getAttribute('data-section-theme') === 'light';
      break;
    }
  }

  if (overLight) {
    nav.setAttribute('data-over-light', '');
  } else {
    nav.removeAttribute('data-over-light');
  }
}

function openPanel() {
  const panel = qs('[data-mobile-panel]');
  const toggle = qs('[data-mobile-toggle]');

  if (!panel || !toggle) return;

  panel.classList.add('is-open');
  toggle.setAttribute('aria-expanded', 'true');
  document.body.style.overflow = 'hidden';

  trapFocus(panel);
}

function closePanel() {
  const panel = qs('[data-mobile-panel]');
  const toggle = qs('[data-mobile-toggle]');

  if (!panel || !toggle) return;

  panel.classList.remove('is-open');
  toggle.setAttribute('aria-expanded', 'false');
  document.body.style.overflow = '';

  toggle.focus();
}

function trapFocus(panelElement) {
  const focusableSelectors = 'a[href], button:not([disabled]), input, textarea, select, [tabindex]:not([tabindex="-1"])';
  const focusableElements = qsa(focusableSelectors, panelElement);

  if (focusableElements.length === 0) return;

  const firstFocusable = focusableElements[0];
  const lastFocusable = focusableElements[focusableElements.length - 1];

  function handleKeydown(e) {
    if (e.key === 'Escape') {
      e.preventDefault();
      closePanel();
      return;
    }

    if (e.key !== 'Tab') return;

    if (e.shiftKey) {
      if (document.activeElement === firstFocusable) {
        e.preventDefault();
        lastFocusable.focus();
      }
    } else {
      if (document.activeElement === lastFocusable) {
        e.preventDefault();
        firstFocusable.focus();
      }
    }
  }

  panelElement.removeEventListener('keydown', panelElement._trapHandler);
  panelElement._trapHandler = handleKeydown;
  panelElement.addEventListener('keydown', handleKeydown);

  firstFocusable.focus();
}

export function init() {
  const nav = qs('[data-nav]');
  if (!nav) return;

  window.addEventListener('scroll', handleScroll, { passive: true });
  window.addEventListener('scrollend', handleScroll, { passive: true });
  handleScroll();

  const toggle = qs('[data-mobile-toggle]');
  if (toggle) {
    toggle.addEventListener('click', () => {
      const panel = qs('[data-mobile-panel]');
      if (panel && panel.classList.contains('is-open')) {
        closePanel();
      } else {
        openPanel();
      }
    });
  }

  qsa('[data-mobile-link] a, .mobile-menu-link, [data-mobile-cta]').forEach((link) => {
    link.addEventListener('click', () => {
      const panel = qs('[data-mobile-panel]');
      if (panel && panel.classList.contains('is-open')) {
        closePanel();
      }
    });
  });
}
