<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
        include '../config.php';
        include '../header/header.php';
?>

<head>
    <meta charset="UTF-8">
    <title>Add Announcement</title>
    <link rel="stylesheet" href="add_anncmnt.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
    
</head>

<section class="announcement-section">
    <div class="modal-container">
        <header class="modal-header">
            <h1 class="modal-title">New Announcement</h1>
            <button type="button" class="close-button">CLOSE</button>
        </header>
        <main class="modal-body">
            <form class="announcement-form">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-input">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-textarea"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="audience">Audience</label>
                        <div class="select-wrapper">
                            <select id="audience" name="audience" class="form-select">
                                <option value="" disabled selected></option>
                                <option value="all">All Users</option>
                                <option value="internal">Internal Only</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="select-wrapper">
                            <select id="status" name="status" class="form-select">
                                <option value="" disabled selected></option>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <div class="input-with-icon">
                        <input type="text" id="date" name="date" class="form-input" placeholder="">
                        <img src="${ASSET_PATH}/176_1646.svg" alt="Calendar Icon" class="input-icon">
                    </div>
                </div>
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="url" id="link" name="link" class="form-input">
                </div>
            </form>
        </main>
        <footer class="modal-footer">
            <button type="submit" class="save-button">SAVE</button>
        </footer>
    </div>
</section>