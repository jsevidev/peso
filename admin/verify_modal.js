document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("verifyModal");
  const approveBtn = document.getElementById("approveBtn");
  const rejectBtn = document.getElementById("rejectBtn");
  const closeBtns = modal.querySelectorAll(".close-modal");
  const verifyStatus = document.getElementById("verifyStatus");
  const verifyName = document.getElementById("verifyName");
  const verifyDocument = document.getElementById("verifyDocument");
  const verifyDocLink = document.getElementById("verifyDocLink");
  const verifyRemarks = document.getElementById("verifyRemarks");
  let currentApplicantId = null;

  // ✅ Create reusable alert element (toast)
  const alertPopup = document.createElement("div");
  alertPopup.className = "alert-popup";
  document.body.appendChild(alertPopup);

  function showAlert(message, isError = false) {
    alertPopup.textContent = message;
    alertPopup.classList.toggle("error", isError);
    alertPopup.classList.add("show");
    setTimeout(() => alertPopup.classList.remove("show"), 2500);
  }

  // ✅ 1. When clicking "Verify Applicant"
  document.querySelectorAll(".verify-btn").forEach((btn) => {
    btn.addEventListener("click", async () => {
      currentApplicantId = btn.dataset.id;
      verifyName.textContent = btn.dataset.name;

      try {
        const res = await fetch(`get_verification_data.php?id=${currentApplicantId}`);
        const data = await res.json();

        // Show image if available
        if (data.document_file && data.document_file.trim() !== "") {
            // ensure proper relative path (you are in /admin/)
            const path = "../" + data.document_file.replace(/^\/+/, ""); 
            verifyDocument.src = path;
            verifyDocLink.href = path;
        } else {
        verifyDocument.src = "../upload/default_doc.png";
        verifyDocLink.removeAttribute("href");
        }


        verifyRemarks.value = data.remarks || "";
        const status = (data.status || "Pending").toLowerCase();
        verifyStatus.textContent = data.status || "Pending";
        verifyStatus.className = `verification-badge ${status}`;

        modal.style.display = "flex"; // ✅ Open modal
      } catch (err) {
        console.error("Error loading verification data:", err);
        showAlert("Error fetching verification data.", true);
      }
    });
  });

  // ✅ 2. Close modal
  closeBtns.forEach((btn) => btn.addEventListener("click", () => (modal.style.display = "none")));
  modal.addEventListener("click", (e) => {
    if (e.target === modal) modal.style.display = "none";
  });

  // ✅ 3. Handle Approve / Reject
  async function handleVerification(status) {
    const remarks = verifyRemarks.value;

    try {
      const response = await fetch("update_verification_status.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ id: currentApplicantId, status, remarks }),
      });

      const result = (await response.text()).trim();
      if (result === "success") {
        modal.style.display = "none";
        showAlert(`Applicant ${status}!`);

        // ✅ Update table instantly
        const tag = document.querySelector(
          `.verification-tag[data-id="${currentApplicantId}"]`
        );
        if (tag) {
          tag.textContent = status;
          tag.className = `verification-tag ${status.toLowerCase()}`;
        }
      } else {
        showAlert("Failed to update verification!", true);
      }
    } catch (err) {
      showAlert("AJAX error!", true);
      console.error(err);
    }
  }

  approveBtn.addEventListener("click", () => handleVerification("Verified"));
  rejectBtn.addEventListener("click", () => handleVerification("Rejected"));
});
