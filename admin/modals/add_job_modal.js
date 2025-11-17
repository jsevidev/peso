document.addEventListener("DOMContentLoaded", () => {
  const openBtn = document.getElementById("openAddJob");
  const modal = document.getElementById("addJobModal");
  const closeBtn = document.getElementById("closeModal");

  if (!openBtn || !modal) return;

  // 🟢 Open modal
  openBtn.addEventListener("click", () => {
    modal.style.display = "flex"; // show modal
    document.body.style.overflow = "hidden"; // disable background scroll
  });

  // 🔴 Close modal
  closeBtn.addEventListener("click", () => {
    modal.style.display = "none"; // hide modal
    document.body.style.overflow = "auto"; // restore scroll
  });

  // 🟡 Close modal when clicking outside the container
  modal.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
      document.body.style.overflow = "auto";
    }
  });
});
