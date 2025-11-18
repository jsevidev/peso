// Function to populate applicant data in the form
function populateApplicantData() {
    if (typeof applicantData !== 'undefined' && applicantData) {
        // Populate form fields with applicant data
        const fullNameInput = document.getElementById('full-name');
        const emailInput = document.getElementById('email');
        const contactInput = document.getElementById('contact-number');
        const resumeDisplay = document.getElementById('resume-display');
        const existingResume = document.getElementById('existing-resume');
        const applProfileIdInput = document.getElementById('application-appl-profile-id');

        if (fullNameInput && applicantData.full_name) {
            fullNameInput.value = applicantData.full_name;
        }
        if (emailInput && applicantData.email) {
            emailInput.value = applicantData.email;
        }
        if (contactInput && applicantData.contact_no) {
            contactInput.value = applicantData.contact_no;
        }
        if (resumeDisplay && applicantData.resume) {
            // Extract filename from path
            const resumeFileName = applicantData.resume.split('/').pop();
            resumeDisplay.value = resumeFileName || 'Resume on file';
        }
        if (existingResume && applicantData.resume) {
            existingResume.value = applicantData.resume;
        }
        if (applProfileIdInput && applicantData.appl_profile_id) {
            applProfileIdInput.value = applicantData.appl_profile_id;
        }
    }
}

// Function to open modal (called from job card onclick)
function openApplyModal(jobId) {
    const modal = document.getElementById('apply-modal');
    if (!modal) {
        console.warn('Apply modal markup not found.');
        return;
    }

    // Clear previous data
    clearModalData();
    
    // Fetch job details
    fetchJobDetails(jobId);
    
    // Populate applicant data
    populateApplicantData();
    
    // Show modal
    modal.style.display = 'flex';
    modal.setAttribute('aria-hidden', 'false');
}

function closeModal() {
    const modal = document.getElementById('apply-modal');
    if (modal) {
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
    }

    const form = document.querySelector('#apply-modal .application-form');
    if (form) {
        form.reset();
    }
}

function clearModalData() {
    // Clear all modal fields
    const fields = {
        'modal-job-title': '',
        'modal-company-name': '',
        'modal-posted-date': '',
        'modal-salary-range': '',
        'modal-job-type': '',
        'modal-description': ''
    };
    
    Object.keys(fields).forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = fields[id];
    });
    
    const skillsContainer = document.getElementById('modal-skills');
    if (skillsContainer) skillsContainer.innerHTML = '';
    
    const jobIdInput = document.getElementById('application-job-id');
    if (jobIdInput) jobIdInput.value = '';
}

function fetchJobDetails(jobId) {
    // AJAX request to fetch job details
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `modal/fetch_job_details.php?job_id=${jobId}`, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                const jobData = JSON.parse(xhr.responseText);
                console.log('Job data received:', jobData);
                
                if (jobData.error) {
                    console.error('Error from server:', jobData.error);
                    return;
                }
                
                // Populate modal with job data
                const jobTitleEl = document.getElementById('modal-job-title');
                if (jobTitleEl) jobTitleEl.textContent = jobData.job_title || 'Job Title';
                
                const companyNameEl = document.getElementById('modal-company-name');
                if (companyNameEl) companyNameEl.textContent = jobData.company_name ? `${jobData.company_name} • ` : '';
                
                const postedDateEl = document.getElementById('modal-posted-date');
                if (postedDateEl) postedDateEl.textContent = jobData.posted_date ? `Posted on ${jobData.posted_date}` : '';
                
                const salaryRangeEl = document.getElementById('modal-salary-range');
                if (salaryRangeEl) salaryRangeEl.textContent = `₱${jobData.salary_min || '0'} - ₱${jobData.salary_max || '0'} / month`;
                
                const jobTypeEl = document.getElementById('modal-job-type');
                if (jobTypeEl) jobTypeEl.textContent = jobData.employment_type || '';
                
                const descriptionEl = document.getElementById('modal-description');
                if (descriptionEl) descriptionEl.textContent = jobData.caption || '';
                
                // Dynamically populate skills
                const skillsContainer = document.getElementById('modal-skills');
                if (skillsContainer) {
                    skillsContainer.innerHTML = '';
                    if (jobData.skills) {
                        jobData.skills.split(',').forEach(skill => {
                            const trimmedSkill = skill.trim();
                            if (trimmedSkill) {
                                const skillTag = document.createElement('span');
                                skillTag.classList.add('skill-tag');
                                skillTag.textContent = trimmedSkill;
                                skillsContainer.appendChild(skillTag);
                            }
                        });
                    }
                }
                
                // Set hidden job ID for form submission
                const jobIdInput = document.getElementById('application-job-id');
                if (jobIdInput) jobIdInput.value = jobData.job_id;
                
            } catch (e) {
                console.error('Error parsing job data:', e);
            }
        } else {
            console.error('Error fetching job details. Status:', xhr.status);
        }
    };
    xhr.onerror = function() {
        console.error('Network error while fetching job details');
    };
    xhr.send();
}

// Consent popup functions
function showConsentPopup() {
    const popup = document.getElementById('consent-popup');
    if (popup) {
        popup.style.display = 'flex';
    }
}

function closeConsentPopup() {
    const popup = document.getElementById('consent-popup');
    if (popup) {
        popup.style.display = 'none';
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('apply-modal');

    // Close modal when clicking outside
    if (modal) {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });
    }

    // Close modal on Escape key
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeModal();
            closeConsentPopup();
        }
    });

    // Form submission handler
    const applicationForm = document.getElementById('application-form');
    if (applicationForm) {
        applicationForm.addEventListener('submit', function(event) {
            const agreementCheckbox = document.getElementById('agreement');
            
            if (!agreementCheckbox.checked) {
                event.preventDefault();
                showConsentPopup();
                return false;
            }
            
            // Form will submit normally if checkbox is checked
        });
    }
});
