
<?php

?>
<head>
    <meta charset="UTF-8">
    <title>AAdmin Sign Up</title>
        <link rel="stylesheet" href="add_appl.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

<body>
    <section id="applicant-form-section">
        <div class="applicant-form-container">
            <header class="form-header">
                <h1 class="header-title">Add Applicant</h1>
                <button class="btn btn-close">CLOSE</button>
            </header>
            <main class="form-body">
                <form class="applicant-form" action="#" method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="tel" id="contact" name="contact">
                        </div>
                        <div class="form-group">
                            <label for="education">Education</label>
                            <input type="text" id="education" name="education">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group form-group-employment">
                            <label for="employment-type">Employment Type</label>
                            <div class="select-wrapper">
                                <select id="employment-type" name="employment-type">
                                    <option value="" disabled selected></option>
                                    <option value="full-time">Full-time</option>
                                    <option value="part-time">Part-time</option>
                                    <option value="contract">Contract</option>
                                    <option value="internship">Internship</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group form-group-full-width">
                            <label for="skills">Skills (comma separated)</label>
                            <input type="text" id="skills" name="skills">
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-save">SAVE</button>
                    </div>
                </form>
            </main>
        </div>
    </section>
</body>




