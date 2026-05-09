import { gsap } from 'gsap';

export function init() {
  const textEls = document.querySelectorAll('[data-hero-animate]');
  const visual = document.querySelector('[data-hero-visual]');
  if (!textEls.length) return;

  const tl = gsap.timeline({ delay: 0.1 });

  tl.set(textEls, { opacity: 0, y: 28 });
  tl.to(textEls, {
    opacity: 1,
    y: 0,
    duration: 0.7,
    stagger: 0.12,
    ease: 'power3.out',
    onComplete() {
      gsap.set(textEls, { clearProps: 'opacity,transform' });
    },
  });

  if (visual) {
    tl.set(visual, { opacity: 0, scale: 0.96 }, 0);
    tl.to(visual, {
      opacity: 1,
      scale: 1,
      duration: 0.9,
      ease: 'power2.out',
      onComplete() {
        gsap.set(visual, { clearProps: 'opacity,transform' });
      },
    }, 0.2);
  }
}
