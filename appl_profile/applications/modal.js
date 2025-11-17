// Function to open the modal and show interview details
function openViewScheduleModal(application_id) {
    // Send request to fetch the details
    fetch('applications/get_interview_schedule.php?id=' + application_id)
    .then(response => response.json())
    .then(data => {
        // Check if the data exists
        if (data.error) {
            console.log(data.error);
            return;
        }
        
        // Populate the modal with the interview details
        const modalContent = document.getElementById("viewModalContent");
        modalContent.innerHTML = `
            <p><strong>Job Title:</strong> ${data.job_title}</p>
            <p><strong>Employer:</strong> ${data.company_name}</p>
            <p><strong>Status:</strong> ${data.status}</p>
            <p><strong>Interview Date:</strong> ${data.interview_date}</p>
            <p><strong>Interview Time:</strong> ${data.interview_time}</p>
            <p><strong>Method:</strong> ${data.interview_method}</p>
            <p><strong>Location:</strong> ${data.interview_location}</p>
            <p><strong>Notes:</strong> ${data.notes}</p>
        `;
        // Show the modal
        document.getElementById("viewScheduleModal").style.display = "flex";
    })
    .catch(error => {
        console.error('Error fetching interview schedule:', error);
    });
}

// Function to close the modal
function closeViewScheduleModal() {
    document.getElementById("viewScheduleModal").style.display = "none";
}
