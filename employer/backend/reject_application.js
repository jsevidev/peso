function rejectApplicant(application_id) {
    if (!confirm("Are you sure you want to reject this applicant?")) return;

    fetch("backend/reject.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + application_id
    })
    .then(res => res.text())
    .then(response => {
        alert(response);
        location.reload(); 
    });
}

function hireApplicant(application_id, job_id) {
    if (!confirm("Mark this applicant as HIRED and close the job posting?")) return;

    fetch("backend/hire.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + application_id + "&job_id=" + job_id
    })
    .then(res => res.text())
    .then(response => {
        alert(response);
        location.reload(); 
    });
}
