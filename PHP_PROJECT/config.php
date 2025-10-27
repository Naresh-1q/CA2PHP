<?php
// config.php
session_start();

// Define file paths
define('USERS_FILE', 'users.json');
define('LOG_FILE', 'login_attempts.log');

// Initialize users file if it doesn't exist
if (!file_exists(USERS_FILE)) {
    file_put_contents(USERS_FILE, json_encode([]));
}

// Initialize log file if it doesn't exist
if (!file_exists(LOG_FILE)) {
    file_put_contents(LOG_FILE, "");
}

// Function to log activities
function log_activity($message) {
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents(LOG_FILE, "[$timestamp] $message\n", FILE_APPEND);
}

// Function to validate email
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>