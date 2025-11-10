<?php
require_once 'config.php';

// Log the logout
if (isset($_SESSION['username'])) {
    log_activity("User logged out: " . $_SESSION['email']);
}

// Destroy all session data
$_SESSION = array();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>