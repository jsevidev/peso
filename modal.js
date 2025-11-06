(function () {
  const modal = document.getElementById('signupModal');
  const dialog = modal?.querySelector('.modal__dialog');
  const openers = document.querySelectorAll('.js-open-signup');
  const closers = modal?.querySelectorAll('.js-close-signup');
  const togglePwdBtn = modal?.querySelector('#togglePwd');
  const pwdInput = modal?.querySelector('#password');

  let lastFocused = null;

  function trapFocus(e) {
    if (!modal || modal.getAttribute('aria-hidden') === 'true') return;
    const focusables = modal.querySelectorAll(
      'a[href], button:not([disabled]), input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    if (!focusables.length) return;
    const first = focusables[0];
    const last = focusables[focusables.length - 1];
    if (e.key === 'Tab') {
      if (e.shiftKey && document.activeElement === first) {
        last.focus();
        e.preventDefault();
      } else if (!e.shiftKey && document.activeElement === last) {
        first.focus();
        e.preventDefault();
      }
    }
  }

  function openModal(e) {
    if (e) e.preventDefault();
    if (!modal) return;
    lastFocused = document.activeElement;
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('modal-open');
    // move focus into dialog
    const firstField = modal.querySelector('#profile-name') || dialog;
    firstField.focus();
    document.addEventListener('keydown', onKeydown);
    document.addEventListener('keydown', trapFocus);
  }

  function closeModal(e) {
    if (e) e.preventDefault();
    if (!modal) return;
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('modal-open');
    document.removeEventListener('keydown', onKeydown);
    document.removeEventListener('keydown', trapFocus);
    if (lastFocused && typeof lastFocused.focus === 'function') {
      lastFocused.focus();
    }
  }

  function onKeydown(e) {
    if (e.key === 'Escape') closeModal();
  }

  // click outside to close
  modal?.addEventListener('click', (e) => {
    if (e.target && e.target.hasAttribute('data-backdrop')) {
      closeModal(e);
    }
  });

  // wire openers/closers
  openers.forEach(btn => btn.addEventListener('click', openModal));
  closers?.forEach(btn => btn.addEventListener('click', closeModal));

  // toggle password visibility
  togglePwdBtn?.addEventListener('click', () => {
    if (!pwdInput) return;
    const showing = pwdInput.type === 'text';
    pwdInput.type = showing ? 'password' : 'text';
    const span = togglePwdBtn.querySelector('span');
    if (span) span.textContent = showing ? 'Show' : 'Hide';
    pwdInput.focus();
  });

  // optional: basic client-side validation guard (prevent accidental submit during testing)
  const form = modal?.querySelector('.signup-form');
  form?.addEventListener('submit', (e) => {
    // remove this block when you wire up server-side handling:
    // e.preventDefault();
    // alert('Submit to server here!');
  });
})();
