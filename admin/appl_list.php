<!doctype html>
<html lang="en">

<?php
include '../config.php';
include 'icon_manager.php';


session_start();

?>
<head>
    <meta charset="UTF-8">  
    <title>Applicant List</title>
        <link rel="stylesheet" href="appl_list.css">
        <link rel="stylesheet" href="forms/add_appl.css">
        <link rel="stylesheet" href="forms/appl_profile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="modal.js"></script>
        <script src="../script.js"></script>  

</head>

<body>
    <header class="site-header">
        <div class="header-container">
            <div class="logo-container">
                <img src="../PESO_logo.png" alt="PESO Log" class="logo-img"> 
                <h1 class="site-title">PESO Ozamiz</h1>
            </div>
            <div class="header-controls">
                <form class="search-form">
                    <input type="search" class="search-input" placeholder="Search Something....">
                    <button type="submit" class="search-button">
                        <?php echo IconManager::renderIcon('search', '', '#ffffff', 'Search'); ?>
                    </button>
                </form>
                <button class="notification-button">
                    <i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;" alt="Notifications"></i>
                </button>

            </div>
        </div>
    </header>

    <section class="dashboard-body">
        
        <aside class="sidebar">
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li class="active"><a href="#">Applicants</a></li>
                    <li><a href="empl_list.php">Employers</a></li>
                    <li><a href="job_posting.php">Job Posting</a></li>
                    <li><a href="application.php">Applications</a></li>
                    <li><a href="job_fair.php">Job Fairs</a></li>
                    <li><a href="anncmnt.php">Announcements</a></li>
                </ul>
            </nav>
            <a href="admin.php" class="logout-button">
                <span>Logout</span>
                <!-- <i class="fa-solid fa-arrow-right-from-bracket fa-lg" alt="Logout icon"></i> -->
                <?php echo IconManager::renderIcon('logout', 'lg'); ?>
            </a>
        </aside>
    
        <main class="main-content">
            <div class="applicants-card">
            <div class="card-header">
                <h2 class="card-title">List of Applicants</h2>
                <button class="add-btn" id="open-form-btn">
                    <i class="fa-solid fa-plus fa-xl" style="color: #ffffff;"></i>
                <span>ADD APPLICANTS</span>
                </button>
            </div>
            <div class="filter-controls">
                <div class="applicant-search">
                <input type="text" placeholder="Search a Applicants">
                <button class="search-btn">Search</button>
                </div>
                <button class="filter-btn">Filter by</button>
            </div>
            <div class="table-wrapper">
                <table class="applicants-table">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Skills</th>
                    <th>Status</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td class="cell-number">1</td>
                    <td>-</td>
                    <td>--</td>
                    <td>----</td>
                    <td>-</td>
                    <td>
                        <div class="status-toggle active">
                        <span>Active</span>
                        <div class="toggle-switch"><div class="toggle-dot"></div></div>
                        <td>
                        <div class="action-icons">
                            <!-- <img src="${EYE_ICON}" alt="View"> 
                            <img src="${ASSET_PATH}/d4a9b3ddec14cca13a5314a3d67133326a2d5a15.png" alt="Edit">
                            <img src="${ASSET_PATH}/108_245.svg" alt="Upload"> -->
                            <a href="#" class="view-profile-btn" data-applicant-id="1">
                                <i class="fa-solid fa-eye" style="color: #105ada;"></i>
                            </a>
                            <i class="fa-solid fa-file-circle-check" style="color: #a5a6a7;"></i>
                            <i class="fa-solid fa-upload" style="color: #23d100;"></i>
                        </div>
                        </td>
                        </div>
                    </td>
                    </tr>
                    <!-- <tr>
                    <td class="cell-number">2</td>
                    <td>Maria Santos</td>
                    <td>maria.santos@email.com</td>
                    <td>0917-222-3333</td>
                    <td>Production Worker</td>
                    <td>
                        <div class="status-toggle inactive">
                        <span>Inactive</span>
                        <div class="toggle-switch"><div class="toggle-dot"></div></div>
                        </div>
                    </td>
                    <td>
                        <div class="action-icons">
                            <img src="${ASSET_PATH}/108_243.svg" alt="View">
                            <img src="${ASSET_PATH}/d4a9b3ddec14cca13a5314a3d67133326a2d5a15.png" alt="Edit">
                            <img src="${ASSET_PATH}/108_245.svg" alt="Upload">
                        </div>
                    </td>
                    </tr>
                    <tr>
                    <td class="cell-number">3</td>
                    <td>Jose Ramirez</td>
                    <td>jose.ramirez@email.com</td>
                    <td>0917-333-4444</td>
                    <td>Service Crew</td>
                    <td>
                        <div class="status-toggle inactive">
                        <span>Inactive</span>
                        <div class="toggle-switch"><div class="toggle-dot"></div></div>
                        </div>
                    </td>
                    <td>
                        <div class="action-icons">
                        <img src="${ASSET_PATH}/108_249.svg" alt="View">
                        <img src="${ASSET_PATH}/d4a9b3ddec14cca13a5314a3d67133326a2d5a15.png" alt="Edit">
                        <img src="${ASSET_PATH}/108_251.svg" alt="Upload">
                        </div>
                    </td>
                    </tr>
                    <tr>
                    <td class="cell-number">4</td>
                    <td>Ana Reyes</td>
                    <td>ana.reyes@email.com</td>
                    <td>0917-444-5555</td>
                    <td>Office Clerk</td>
                    <td>
                        <div class="status-toggle active">
                        <span>Active</span>
                        <div class="toggle-switch"><div class="toggle-dot"></div></div>
                        </div>
                    </td>
                    <td>
                        <div class="action-icons">
                        <img src="${ASSET_PATH}/108_255.svg" alt="View">
                        <img src="${ASSET_PATH}/d4a9b3ddec14cca13a5314a3d67133326a2d5a15.png" alt="Edit">
                        <img src="${ASSET_PATH}/108_257.svg" alt="Upload">
                        </div>
                    </td>
                    </tr>

                    <tr>
                    <td class="cell-number">5</td>
                    <td>Ana Reyes</td>
                    <td>ana.reyes@email.com</td>
                    <td>0917-444-5555</td>
                    <td>Office Clerk</td>
                    <td>
                        <div class="status-toggle active">
                        <span>Active</span>
                        <div class="toggle-switch"><div class="toggle-dot"></div></div>
                        </div>
                    </td>
                    <td>
                        <div class="action-icons">
                        <img src="${ASSET_PATH}/108_255.svg" alt="View">
                        <img src="${ASSET_PATH}/d4a9b3ddec14cca13a5314a3d67133326a2d5a15.png" alt="Edit">
                        <img src="${ASSET_PATH}/108_257.svg" alt="Upload">
                        </div>
                    </td>
                    </tr> -->

                    </tbody>
                </table>
            </div>
            </div>
        </main>
    </section>
    <?php include 'forms/add_appl.php'; ?>
    <?php include 'forms/appl_profile.php'; ?>
</body>

</html>


