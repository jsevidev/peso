<!doctype html>
<html lang="en">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
    include '../config.php';
    include '../header/admin_header.php';

?>
<head>
    <meta charset="UTF-8">
    <title>Admin Sign Up</title>
        <link rel="stylesheet" href="anncmnt.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

<body>
    
<!-- <section class="dashboard-body"> -->
    <div class="main-panel">
        <main class="content-area" id="announcements">
        <section class="announcements-section">
            <div class="announcements-header">
            <h2>Announcements</h2>
            <button class="new-announcement-btn">
                <i class="fa-solid fa-plus fa-xl" style="color: #ffffff;"></i>
                <span>NEW ANNOUNCEMENT</span>
            </button>
            </div>

            <div class="announcements-filters">
            <!-- <div class="filter-search">
                <input type="text" placeholder="Search a Jobs">
                <button>Search</button>
            </div> -->
            <div class="filter-dropdown">
                <span>Audience</span>
                <!--merged image-->
                <div class="icon-container">
                <img src="${ASSET_PATH}/118_749.svg" alt="Calendar icon" class="icon-calendar">
                <img src="${ASSET_PATH}/120_859.svg" alt="Dropdown arrow" class="icon-arrow">
                </div>
            </div>
            <div class="filter-dropdown">
                <span>Status</span>
                <img src="${ASSET_PATH}/120_862.svg" alt="Dropdown arrow">
            </div>
            <button class="filter-clear-btn">Clear</button>
            </div>

            <div class="announcements-table">
            <div class="table-header">
                <div class="col-title">Title & Description</div>
                <div class="col-date">Date</div>
                <div class="col-audience">Audience</div>
                <div class="col-status">Status</div>
                <div class="col-action">Action</div>
            </div>

            <div class="table-row">
                <div class="col-title">
                <p class="item-title">Government Hiring Caravan</p>
                <p class="item-desc">Multiple agencies will be hiring on-site bring government IDs and NSO/PSA copies.</p>
                </div>
                <div class="col-date">2025-09-20</div>
                <div class="col-audience">All</div>
                <div class="col-status status-published">Published</div>
                <div class="col-action">
                <button class="action-btn btn-edit">Edit</button>
                <button class="action-btn btn-delete">Delete</button>
                <button class="action-btn btn-unpublish">Unpublished</button>
                </div>
            </div>

            <div class="table-row">
                <div class="col-title">
                <p class="item-title">BPO Hiring Week</p>
                <p class="item-desc">Walk-in interviews for customer service roles. Competitive salary plus incentives</p>
                </div>
                <div class="col-date">2025-09-18</div>
                <div class="col-audience">All</div>
                <div class="col-status status-published">Published</div>
                <div class="col-action">
                <button class="action-btn btn-edit">Edit</button>
                <button class="action-btn btn-delete">Delete</button>
                <button class="action-btn btn-unpublish">Unpublished</button>
                </div>
            </div>

            <div class="table-row">
                <div class="col-title">
                <p class="item-title">PESO Mega Job Fair</p>
                <p class="item-desc">Join our Mega Job Fair at Ozamiz City Hall Gym. Bring valid IDs and multiple copies of your resume.</p>
                </div>
                <div class="col-date">2025-09-15</div>
                <div class="col-audience">All</div>
                <div class="col-status status-unpublished">Unpublished</div>
                <div class="col-action">
                <button class="action-btn btn-edit">Edit</button>
                <button class="action-btn btn-delete">Delete</button>
                <button class="action-btn btn-publish">Published</button>
                </div>
            </div>
            </div>
        </section>
        </main>
    </div>
</body>

</html>


