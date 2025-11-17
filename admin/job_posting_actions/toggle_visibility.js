document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".toggle-visibility-btn").forEach(button => {
        button.addEventListener("click", function () {

            let jobId = this.dataset.jobid;
            let row = this.closest("tr"); // the row of this job
            let visibilityCell = row.querySelector("td:nth-child(7)");

            fetch("job_posting_actions/toggle_visibility.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "job_id=" + jobId
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {

                    // Update visibility text in table
                    visibilityCell.textContent = data.newVisibility;
                    visibilityCell.className = 
                        (data.newVisibility === "Published")
                        ? "status-published"
                        : "status-unpublished";

                    // Update button text
                    this.textContent = data.buttonLabel;

                    // Update button class
                    this.classList.remove("action-unpublished", "action-published");
                    this.classList.add(data.buttonClass);
                }
            });
        });
    });

});
