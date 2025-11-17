
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('viewModal');
  const closeButtons = modal.querySelectorAll('.close-modal');

  document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      // populate data
      document.getElementById('viewFullName').textContent = btn.dataset.name || 'N/A';
      document.getElementById('viewBirthDate').textContent = btn.dataset.birth || 'N/A';
      document.getElementById('viewGender').textContent = btn.dataset.gender || 'N/A';
      document.getElementById('viewContact').textContent = btn.dataset.contact || 'N/A';
      document.getElementById('viewEmail').textContent = btn.dataset.email || 'N/A';
      document.getElementById('viewAddress').textContent = btn.dataset.address || 'N/A';
      document.getElementById('viewEducation').textContent = btn.dataset.education || 'N/A';
      document.getElementById('viewSkills').textContent = btn.dataset.skills || 'N/A';
      document.getElementById('viewExperience').textContent = btn.dataset.experience || 'N/A';

      // profile picture
      const pic = btn.dataset.pic;
      const profilePic = document.getElementById('viewProfilePic');
      profilePic.src = (pic && pic.trim() !== '') ? pic : '../upload/profile_pics/default_profile.png';


      // show modal
      modal.style.display = 'flex';
    });
  });

  // close modal buttons
  closeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      modal.style.display = 'none';
    });
  });

  // close when clicking outside
  modal.addEventListener('click', e => {
    if (e.target === modal) modal.style.display = 'none';
  });
});

