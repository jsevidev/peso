<?php
    session_start();
    session_unset(); // remove all session variables
    session_destroy(); // destroy session
    header("Location: ../nav/home.php");
    exit();
?>
s