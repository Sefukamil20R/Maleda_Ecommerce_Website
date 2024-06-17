<?php
if (count(get_included_files()) == 1) exit("Direct access not permitted.");

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not, redirect them to the login page
    header('Location: ../login.php');
    exit;
}
?>