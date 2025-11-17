// ADD JOB FAIR MODAL
document.querySelector(".add-job-fair-button").addEventListener("click", function(e) {
    e.preventDefault();
    document.getElementById("addJobFairModal").style.display = "flex";
});

// EDIT JOB FAIR MODAL LOAD
function editJobFair(id) {
    document.getElementById("jobfair-modal").style.display = "flex";

    fetch("job_fairs_func/get_jobfair.php?id=" + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById("jf_id").value = data.jobfair_id;
            document.getElementById("title").value = data.title;
            document.getElementById("participating_companies").value = data.participating_companies;
            document.getElementById("location").value = data.location;
            document.getElementById("date").value = data.date;
            document.getElementById("status").value = data.status;
            document.getElementById("link").value = data.link;
        });
}

// DELETE JOB FAIR
function deleteJobFair(id) {
    if (confirm("Are you sure you want to delete this job fair?")) {
        window.location.href = "job_fairs_func/delete_jobfair.php?id=" + id;
    }
}
