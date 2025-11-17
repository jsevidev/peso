const profilecont = document.querySelector('.edit-profile-container');
const editprofilebtn = document.querySelector('.edit-profile-btn');
const closemodalbtn = document.querySelector('.close-btn');

// editprofilebtn.addEventListener('click', () => profilecont.classList.add('slide'));
// closemodalbtn.addEventListener('click', () => profilecont.classList.remove('slide'));

// editprofilebtn.addEventListener('click', () => profilecont.classList.add('show'));
// closemodalbtn.addEventListener('click', () => profilecont.classList.remove('show'));


// ✅ Open modal
editprofilebtn.addEventListener('click', () => {
  profilecont.classList.add('show');     // show overlay + modal
  document.body.style.overflow = 'hidden'; // disable background scroll
});

// ✅ Close modal
closemodalbtn.addEventListener('click', () => {
  profilecont.classList.remove('show');
  document.body.style.overflow = ''; // restore background scroll
});

// ✅ Close when clicking background overlay
profilecont.addEventListener('click', (event) => {
  if (event.target === profilecont) {
    profilecont.classList.remove('show');
    document.body.style.overflow = '';
  }
});


// ✅ Allow every pencil icon to open the same edit modal
document.querySelectorAll('.edit-section').forEach(button => {
  button.addEventListener('click', (e) => {
    e.preventDefault();
    profilecont.classList.add('show');
    document.body.style.overflow = 'hidden';

    const target = button.dataset.target; // e.g. "#skills"
    const field = document.querySelector(target);
    if (field) field.scrollIntoView({ behavior: 'smooth', block: 'center' });
  });
});
