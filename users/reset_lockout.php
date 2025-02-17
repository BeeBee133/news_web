<?php
// Start the session
session_start();

// Check if the session variables exist, then unset them
if (isset($_SESSION['failed_attempts'])) {
    unset($_SESSION['failed_attempts']);
}

if (isset($_SESSION['last_failed_attempt'])) {
    unset($_SESSION['last_failed_attempt']);
}

echo "Login lockout has been manually reset.";
