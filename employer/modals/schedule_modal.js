function openScheduleModal(application_id, employer_id, appl_profile_id, job_posting_id) {
    document.getElementById("sched_application_id").value = application_id;
    document.getElementById("sched_employer_id").value = employer_id;
    document.getElementById("sched_appl_profile_id").value = appl_profile_id;
    document.getElementById("sched_job_posting_id").value = job_posting_id;

    document.getElementById("scheduleModal").style.display = "flex";
}

function closeScheduleModal() {
    document.getElementById("scheduleModal").style.display = "none";
}

function saveSchedule() {
    let formData = new FormData();
    formData.append("application_id", document.getElementById("sched_application_id").value);
    formData.append("employer_id", document.getElementById("sched_employer_id").value);
    formData.append("appl_profile_id", document.getElementById("sched_appl_profile_id").value);
    formData.append("job_posting_id", document.getElementById("sched_job_posting_id").value);
    formData.append("interview_date", document.getElementById("interview_date").value);
    formData.append("interview_time", document.getElementById("interview_time").value);
    formData.append("method", document.getElementById("method").value);
    formData.append("location", document.getElementById("location").value);
    formData.append("notes", document.getElementById("notes").value);

    fetch("backend/save_interview.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        alert(result);
        closeScheduleModal();
        location.reload();
    });
}