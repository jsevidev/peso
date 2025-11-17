document.addEventListener('DOMContentLoaded', () => {
  const openBtn = document.getElementById('open-form-btn');
  const modal = document.querySelector('.edit-profile-container');
  const closeBtn = modal.querySelector('.close-btn');

  // Open modal
  openBtn.addEventListener('click', () => {
    modal.classList.add('show');
  });

  // Close modal
  closeBtn.addEventListener('click', () => {
    modal.classList.remove('show');
  });

  // Optional: close when clicking outside the modal box
  modal.addEventListener('click', (e) => {
    if (e.target === modal) modal.classList.remove('show');
  });
});
