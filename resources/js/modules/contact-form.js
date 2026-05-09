export function init() {
  const form = document.querySelector('[data-contact-form]');
  if (!form) return;

  const submitBtn = form.querySelector('[data-contact-submit]');
  const errorBanner = form.querySelector('[data-contact-error-banner]');

  // The page is statically cached, so the server-rendered form_loaded_at timestamp
  // would be stale on revisits — refresh it client-side at load.
  const loadedAtInput = form.querySelector('input[name="form_loaded_at"]');
  if (loadedAtInput) loadedAtInput.value = Math.floor(Date.now() / 1000);

  function showFieldError(fieldName, message) {
    const errorEl = form.querySelector(`[data-contact-error-for="${fieldName}"]`);
    if (errorEl) {
      errorEl.textContent = message;
      errorEl.classList.add('is-visible');
    }
    const input = form.querySelector(`[name="${fieldName}"]`);
    if (input) input.setAttribute('data-state', 'invalid');
    return Boolean(errorEl);
  }

  function showBannerError(message) {
    if (!errorBanner || !message) return;
    errorBanner.textContent = message;
    errorBanner.classList.add('is-visible');
  }

  function clearAllErrors() {
    form.querySelectorAll('.form-error').forEach((el) => {
      el.textContent = '';
      el.classList.remove('is-visible');
    });
    form.querySelectorAll('[data-state="invalid"]').forEach((el) => {
      el.removeAttribute('data-state');
    });
    if (errorBanner) {
      errorBanner.textContent = '';
      errorBanner.classList.remove('is-visible');
    }
  }

  function setState(newState) {
    form.dataset.state = newState;
    const inputs = form.querySelectorAll('input, textarea, button');
    const isLocked = newState === 'loading' || newState === 'success';
    inputs.forEach((el) => (el.disabled = isLocked));
    if (submitBtn) {
      if (newState === 'loading') submitBtn.setAttribute('aria-busy', 'true');
      else submitBtn.removeAttribute('aria-busy');
    }
  }

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    if (form.dataset.state === 'loading' || form.dataset.state === 'success') return;

    // Build FormData BEFORE setState('loading') disables inputs
    // (FormData skips disabled fields, which would send an empty payload).
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    const formData = new FormData(form);

    setState('loading');

    try {
      const response = await fetch(form.action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData,
      });

      if (response.ok) {
        clearAllErrors();
        setState('success');
        return;
      }

      if (response.status === 422) {
        const data = await response.json();
        clearAllErrors();
        const orphanMessages = [];
        if (data.errors) {
          Object.entries(data.errors).forEach(([field, messages]) => {
            const shown = showFieldError(field, messages[0]);
            if (!shown && messages[0]) orphanMessages.push(messages[0]);
          });
        }
        if (orphanMessages.length) showBannerError(orphanMessages.join(' '));
        setState('error');
        return;
      }

      clearAllErrors();
      if (response.status === 429) {
        showBannerError(form.dataset.rateLimitMessage ?? '');
      } else {
        showBannerError(form.dataset.errorMessage ?? '');
      }
      setState('error');
    } catch {
      clearAllErrors();
      showBannerError(form.dataset.errorMessage ?? '');
      setState('error');
    }
  });
}
