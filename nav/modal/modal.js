document.querySelectorAll('.apply-btn').forEach(button => {
     button.addEventListener('click', function() {
         const jobId = this.getAttribute('data-job-id');
         const jobTitle = this.getAttribute('data-job-title');

         // Check if the button click is being captured
         console.log("Job ID: " + jobId + " | Job Title: " + jobTitle);  // Debugging log

         // Set the job title in the modal
         document.getElementById('modal-job-title').textContent = jobTitle;

         // Fetch job details dynamically
         fetchJobDetails(jobId);

         // Display the modal
         document.getElementById('apply-modal').style.display = 'flex';
     });
});

function closeModal() {
     document.getElementById('apply-modal').style.display = 'none';
}

function fetchJobDetails(jobId) {
     // AJAX request to fetch job details
     const xhr = new XMLHttpRequest();
     xhr.open('GET', `fetch_job_details.php?job_id=${jobId}`, true);
     xhr.onload = function() {
         if (xhr.status === 200) {
             const jobData = JSON.parse(xhr.responseText);
             console.log(jobData);  // Debugging log to check the job data

             // Populate modal with job data
             document.getElementById('modal-job-meta').textContent = `${jobData.company_name} • Posted on ${jobData.posted_date}`;
             document.getElementById('modal-salary-info').innerHTML = `<p class="salary-range">₱${jobData.salary_min} - ₱${jobData.salary_max} / month</p><span class="job-type-tag">${jobData.employment_type}</span>`;
             document.getElementById('modal-description').textContent = jobData.caption;

             // Dynamically populate skills
             const skillsContainer = document.getElementById('modal-skills');
             skillsContainer.innerHTML = '';
             jobData.skills.split(',').forEach(skill => {
                 const skillTag = document.createElement('span');
                 skillTag.classList.add('skill-tag');
                 skillTag.textContent = skill.trim();
                 skillsContainer.appendChild(skillTag);
             });
         }
     };
     xhr.send();
}
