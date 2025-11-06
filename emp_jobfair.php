<!doctype html>
<html lang="en">
<?php
include 'config.php';
session_start();

if (isset($_POST['login'])) {
    //connect to database
    $mysqli = new mysqli("localhost", "root", "", "peso");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    //check if account exists
    $stmt = $mysqli->prepare("SELECT * FROM applicant_account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        //use password_verify to check hashed passwords
        if (password_verify($password, $row['password'])) { 
            $_SESSION['email'] = $email;
            error_log("Login successful, redirecting...");
            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Invalid username or password!";
    }

    $stmt->close();
    $mysqli->close();
}
?>
<head>
    <meta charset="UTF-8">
    <title>Job Posting</title>
        <link rel="stylesheet" href="emp_jobfair.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

 <body>
    <section id="dashboard">
    <div class="dashboard-layout">
        <aside class="sidebar">
        <div class="sidebar-nav">
            <a href="#job-fairs" class="nav-item active">
            Job Fairs
            </a>
            <a href="#job-posting" class="nav-item">
            Job Posting
            </a>
        </div>
        <!--merged image-->
        <button class="logout-btn">
            <span>Logout</span>
            <img src="${ASSET_PATH}/213_564.svg" alt="Logout Icon">
        </button>
        </aside>

        <div class="main-panel">
        <header class="page-header">
            <div class="brand">
            <img src="${ASSET_PATH}/dace5010978b5402a1fc354653a8f909f806489b.png" alt="PESO Logo" class="logo">
            <h1 class="brand-title">PESO Ozamiz</h1>
            </div>
            <div class="header-controls">
            <div class="header-search">
                <input type="text" placeholder="Search Something....">
                <button class="search-btn">Search</button>
            </div>
            <button class="icon-btn">
                <img src="${ASSET_PATH}/213_585.svg" alt="Notifications">
            </button>
            <button class="employer-btn">Employer</button>
            </div>
        </header>

        <main class="content-wrapper">
            <div class="content-header">
            <h2 class="content-title">Job Fairs</h2>
            <!--merged image-->
            <button class="add-job-fair-btn">
                <img src="${ASSET_PATH}/213_608.svg" alt="Add Icon">
                <span>ADD JOB FAIR</span>
            </button>
            </div>

            <div class="filters-bar">
            <div class="filter-group">
                <input type="text" placeholder="Search a Jobs" class="filter-search-input">
                <button class="filter-search-btn">Search</button>
            </div>
            <div class="filter-group date-filter">
                <label>Date From</label>
                <img src="${ASSET_PATH}/213_612.svg" alt="Calendar Icon">
            </div>
            <div class="filter-group date-filter">
                <label>Date To</label>
                <img src="${ASSET_PATH}/213_620.svg" alt="Calendar Icon">
            </div>
            <button class="clear-btn">Clear</button>
            </div>

            <div class="table-container">
            <div class="table-grid table-header">
                <div>Title</div>
                <div>Date</div>
                <div>Location</div>
                <div>Participating Companies</div>
                <div>Announcements</div>
                <div>Status</div>
                <div>Action</div>
            </div>

            <div class="table-grid table-row">
                <div class="cell-title">Retail & Services<br>Job Match</div>
                <div>2025-09-20</div>
                <div class="cell-location">Gaisano Mall<br>Activity Center</div>
                <div class="company-tags">
                <span>Gaisano</span>
                <span>Watsons</span>
                <span>MR.DIY</span>
                </div>
                <div><a href="#" class="link">Add link</a></div>
                <div><span class="status-past">Past</span></div>
                <div class="action-buttons">
                <button class="action-btn edit-btn">Edit</button>
                <button class="action-btn delete-btn">Delete</button>
                </div>
            </div>

            <div class="table-grid table-row">
                <div class="cell-title">PESO Ozamiz<br>Mega Job Fair</div>
                <div>2025-10-15</div>
                <div class="cell-location">Ozamiz City Hall<br>Gym</div>
                <div class="company-tags">
                <span>Jollibee</span>
                <span>Gaisano</span>
                <span>MR.DIY</span>
                </div>
                <div><a href="#" class="link-view">View<br>Announcement</a></div>
                <div><span class="status-upcoming">Upcoming</span></div>
                <div class="action-buttons">
                <button class="action-btn edit-btn">Edit</button>
                <button class="action-btn delete-btn">Delete</button>
                </div>
            </div>

            <div class="table-grid table-row">
                <div class="cell-title">BPO & Customer<br>Care Fair</div>
                <div>2025-10-18</div>
                <div class="cell-location">City Multipurpose<br>Hall</div>
                <div class="company-tags">
                <span>Jollibee</span>
                <span>DOH</span>
                <span>MR.DIY</span>
                </div>
                <div><a href="#" class="link">Add link</a></div>
                <div><span class="status-past">Past</span></div>
                <div class="action-buttons">
                <button class="action-btn edit-btn">Edit</button>
                <button class="action-btn delete-btn">Delete</button>
                </div>
            </div>

            <div class="table-grid table-row">
                <div class="cell-title">Government Hiring<br>Caravan</div>
                <div>2025-10-25</div>
                <div class="cell-location">City Engineers<br>Office Grounds</div>
                <div class="company-tags">
                <span>City Hall</span>
                <span>City Engineers</span>
                <span>MR.DIY</span>
                <span>DSWD</span>
                </div>
                <div><a href="#" class="link">Add link</a></div>
                <div><span class="status-upcoming">Upcoming</span></div>
                <div class="action-buttons">
                <button class="action-btn edit-btn">Edit</button>
                <button class="action-btn delete-btn">Delete</button>
                </div>
            </div>

            <div class="table-grid table-row">
                <div class="cell-title">Hospital & Health<br>Jobs Day</div>
                <div>2025-10-30</div>
                <div class="cell-location">Medina Hospital<br>Lobby</div>
                <div class="company-tags">
                <span>DOH</span>
                <span>PhilHealth</span>
                <span>Medina Hospital</span>
                </div>
                <div><a href="#" class="link">Add link</a></div>
                <div><span class="status-past">Past</span></div>
                <div class="action-buttons">
                <button class="action-btn edit-btn">Edit</button>
                <button class="action-btn delete-btn">Delete</button>
                </div>
            </div>
            </div>
        </main>
        </div>
    </div>
    </section>
 </body>

</html>


