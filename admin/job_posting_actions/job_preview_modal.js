// OPEN PREVIEW MODAL
document.querySelectorAll('.preview-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        const jobId = this.dataset.jobid;

        fetch(`forms/preview_job.php?job_id=${jobId}`)
            .then(res => res.text())
            .then(data => {
                document.getElementById('previewContent').innerHTML = data;
                document.getElementById('previewModal').style.display = 'flex';
            });
    });
});

// CLOSE PREVIEW MODAL
document.getElementById('closePreview').addEventListener('click', () => {
    document.getElementById('previewModal').style.display = 'none';
});
// OPEN PREVIEW MODAL
document.querySelectorAll('.preview-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        const jobId = this.dataset.jobid;

        fetch(`job_posting_actions/preview_job.php?job_id=${jobId}`)
            .then(res => res.text())
            .then(data => {
                document.getElementById('previewContent').innerHTML = data;
                document.getElementById('previewModal').style.display = 'flex';
            });
    });
});

// CLOSE PREVIEW MODAL
document.getElementById('closePreview').addEventListener('click', () => {
    document.getElementById('previewModal').style.display = 'none';
});
