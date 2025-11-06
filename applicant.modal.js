(function () {
  const modal = document.getElementById('applicantModal');
  const dialog = modal?.querySelector('.modal__dialog');
  const openers = document.querySelectorAll('.js-open-applicant');
  const closers = modal?.querySelectorAll('.js-close-applicant');
  const togglePwdBtn = modal?.querySelector('#app-togglePwd');
  const pwdInput = modal?.querySelector('#app-password');

  let lastFocused = null;

  function openModal(e) {
    if (e) e.preventDefault();
    if (!modal) return;
    lastFocused = document.activeElement;
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('modal-open');
    (modal.querySelector('#app-profile-name') || dialog).focus();
    document.addEventListener('keydown', onKeydown);
  }

  function closeModal(e) {
    if (e) e.preventDefault();
    if (!modal) return;
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('modal-open');
    document.removeEventListener('keydown', onKeydown);
    if (lastFocused && typeof lastFocused.focus === 'function') lastFocused.focus();
  }

  function onKeydown(e) {
    if (e.key === 'Escape') closeModal();
    if (e.key === 'Tab') trapFocus(e);
  }

  function trapFocus(e) {
    if (modal.getAttribute('aria-hidden') === 'true') return;
    const focusables = modal.querySelectorAll(
      'a[href], button:not([disabled]), input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    if (!focusables.length) return;
    const first = focusables[0];
    const last = focusables[focusables.length - 1];
    if (e.shiftKey && document.activeElement === first) { last.focus(); e.preventDefault(); }
    else if (!e.shiftKey && document.activeElement === last) { first.focus(); e.preventDefault(); }
  }

  openers.forEach(btn => btn.addEventListener('click', openModal));
  closers?.forEach(btn => btn.addEventListener('click', closeModal));
  modal?.addEventListener('click', (e) => {
    if (e.target && e.target.hasAttribute('data-backdrop')) closeModal(e);
  });

  togglePwdBtn?.addEventListener('click', () => {
    if (!pwdInput) return;
    const show = pwdInput.type === 'password';
    pwdInput.type = show ? 'text' : 'password';
    const span = togglePwdBtn.querySelector('span');
    if (span) span.textContent = show ? 'Hide' : 'Show';
    pwdInput.focus();
  });

  // Optional: keep as real submit (remove preventDefault if posting normally)
  const form = modal?.querySelector('.signup-form');
  form?.addEventListener('submit', (e) => {
    // e.preventDefault();
    // Do AJAX or let standard POST happen to applicant_signup_handler.php
  });
})();
