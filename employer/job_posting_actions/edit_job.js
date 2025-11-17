document.querySelectorAll(".edit-btn").forEach(btn => {
    btn.addEventListener("click", function() {

        let id = this.dataset.jobid;

        fetch("job_posting_actions/get_jobposting.php?job_id=" + id)
        .then(r => r.json())
        .then(data => {

            document.getElementById("edit_job_id").value = data.job_id;
            document.getElementById("edit_job_title").value = data.job_title;

            document.getElementById("edit_employer_id").value = data.employer_id;

            document.getElementById("edit_job_type").value = data.employment_type;
            document.getElementById("edit_posted_date").value = data.posted_date;

            document.getElementById("edit_salary_min").value = data.salary_min;
            document.getElementById("edit_salary_max").value = data.salary_max;

            document.getElementById("edit_skills").value = data.skills;
            document.getElementById("edit_caption").value = data.caption;

            document.getElementById("edit_moderation").value = data.moderation;
            document.getElementById("edit_visibility").value = data.visibility;

            document.getElementById("editJobModal").style.display = "flex";
        });
    });
});

document.getElementById("closeEditJob").addEventListener("click", () => {
    document.getElementById("editJobModal").style.display = "none";
});
