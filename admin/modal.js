// // document.addEventListener('DOMContentLoaded', function() {
// //     console.log('Modal script loaded'); // Debug log
    
// //     // 1. Get elements
// //     const openBtn = document.getElementById('open-form-btn');
// //     const formSection = document.getElementById('applicant-form-section');
    
// //     console.log('Open button:', openBtn); // Debug log
// //     console.log('Form section:', formSection); // Debug log
    
// //     // Only proceed if the modal container exists
// //     if (!formSection) {
// //         console.error('Modal container not found!');
// //         return;
// //     }
    
// //     const closeBtn = formSection.querySelector('.btn-close'); 
// //     console.log('Close button:', closeBtn); // Debug log
    
// //     // 2. Open the form when the 'ADD APPLICANTS' button is clicked
// //     if (openBtn) {
// //         openBtn.addEventListener('click', function(e) {
// //             e.preventDefault();
// //             console.log('Open button clicked'); // Debug log
// //             formSection.classList.add('show');
// //             document.body.style.overflow = 'hidden'; // Prevent background scrolling
// //         });
// //     } else {
// //         console.error('Open button not found!');
// //     }

// //     // 3. Close the form when the 'CLOSE' button is clicked
// //     if (closeBtn) {
// //         closeBtn.addEventListener('click', function(e) {
// //             e.preventDefault();
// //             console.log('Close button clicked'); // Debug log
// //             formSection.classList.remove('show');
// //             document.body.style.overflow = ''; // Restore scrolling
// //         });
// //     } else {
// //         console.error('Close button not found in modal!');
// //     }

// //     // 4. Close the form when clicking the dark background overlay
// //     formSection.addEventListener('click', function(event) {
// //         if (event.target === formSection) {
// //             console.log('Background clicked'); // Debug log
// //             formSection.classList.remove('show');
// //             document.body.style.overflow = ''; // Restore scrolling
// //         }
// //     });

// //     // 5. Close when the ESC key is pressed
// //     document.addEventListener('keydown', function(e) {
// //         if (e.key === 'Escape' && formSection.classList.contains('show')) {
// //             console.log('ESC key pressed'); // Debug log
// //             formSection.classList.remove('show');
// //             document.body.style.overflow = ''; // Restore scrolling
// //         }
// //     });
// // });

// document.addEventListener('DOMContentLoaded', function() {
//     console.log('Modal script loaded');
    
//     // Modal configuration
//     const modals = [
//         {
//             openBtn: 'open-form-btn',
//             modalId: 'applicant-form-section',
//             closeBtnClass: 'btn-close'
//         },
//         {
//             openBtn: 'view-profile-btn', // This will be handled differently
//             modalId: 'applicant-profile',
//             closeBtnClass: 'close-button'
//         }
//     ];

//     // Initialize each modal
//     modals.forEach(modalConfig => {
//         if (modalConfig.openBtn === 'view-profile-btn') {
//             // Special handling for view profile buttons (multiple buttons)
//             initializeViewProfileModal(modalConfig);
//         } else {
//             // Standard modal initialization
//             initializeModal(modalConfig);
//         }
//     });

//     function initializeModal(config) {
//         const openBtn = document.getElementById(config.openBtn);
//         const modal = document.getElementById(config.modalId);
        
//         if (!modal) {
//             console.error(`Modal ${config.modalId} not found!`);
//             return;
//         }

//         const closeBtn = modal.querySelector(`.${config.closeBtnClass}`);
        
//         // Open modal
//         if (openBtn) {
//             openBtn.addEventListener('click', function(e) {
//                 e.preventDefault();
//                 console.log(`Opening modal: ${config.modalId}`);
//                 modal.classList.add('show');
//                 document.body.style.overflow = 'hidden';
//             });
//         }

//         // Close modal with close button
//         if (closeBtn) {
//             closeBtn.addEventListener('click', function(e) {
//                 e.preventDefault();
//                 console.log(`Closing modal: ${config.modalId}`);
//                 modal.classList.remove('show');
//                 document.body.style.overflow = '';
//             });
//         }

//         // Close modal when clicking background
//         modal.addEventListener('click', function(event) {
//             if (event.target === modal) {
//                 console.log(`Closing modal via background: ${config.modalId}`);
//                 modal.classList.remove('show');
//                 document.body.style.overflow = '';
//             }
//         });
//     }

//     function initializeViewProfileModal(config) {
//         const modal = document.getElementById(config.modalId);
        
//         if (!modal) {
//             console.error(`Modal ${config.modalId} not found!`);
//             return;
//         }

//         const closeBtn = modal.querySelector(`.${config.closeBtnClass}`);
//         const viewProfileButtons = document.querySelectorAll('.view-profile-btn');

//         // Open modal for each view profile button
//         viewProfileButtons.forEach(button => {
//             button.addEventListener('click', function(e) {
//                 e.preventDefault();
                
//                 // Get applicant data (you can customize this based on your data)
//                 const applicantId = this.getAttribute('data-applicant-id');
//                 console.log(`Opening profile for applicant: ${applicantId}`);
                
//                 // Here you can load applicant data dynamically
//                 loadApplicantData(applicantId);
                
//                 modal.classList.add('show');
//                 document.body.style.overflow = 'hidden';
//             });
//         });

//         // Close modal with close button
//         if (closeBtn) {
//             closeBtn.addEventListener('click', function(e) {
//                 e.preventDefault();
//                 modal.classList.remove('show');
//                 document.body.style.overflow = '';
//             });
//         }

//         // Close modal when clicking background
//         modal.addEventListener('click', function(event) {
//             if (event.target === modal) {
//                 modal.classList.remove('show');
//                 document.body.style.overflow = '';
//             }
//         });
//     }

//     // Function to load applicant data (you can customize this)
//     function loadApplicantData(applicantId) {
//         // This is where you would typically make an AJAX call to get applicant data
//         console.log(`Loading data for applicant ID: ${applicantId}`);
        
//         // For now, we'll just update the title
//         const profileTitle = document.querySelector('#applicant-profile .profile-title');
//         if (profileTitle) {
//             profileTitle.textContent = `Applicant Profile - ID: ${applicantId}`;
//         }
        
//         // You can add more data loading logic here
//         // Example: document.getElementById('name').value = data.name;
//     }

//     // Global close function for ESC key
//     document.addEventListener('keydown', function(e) {
//         if (e.key === 'Escape') {
//             modals.forEach(config => {
//                 const modal = document.getElementById(config.modalId);
//                 if (modal && modal.classList.contains('show')) {
//                     modal.classList.remove('show');
//                     document.body.style.overflow = '';
//                 }
//             });
//         }
//     });
// });