<?php
// Start the session
session_start();

// Check if the user is logged in
function is_logged_in() {
    return isset($_SESSION["user_id"]);
}

// Redirect to login page if user is not logged in
function require_login() {
    if (!is_logged_in()) {
        header("Location: connexion.php");
        exit();
    }
}

// Check if the user has the required role
// If not, redirect to home page with an error
function require_role($role) {
    require_login();
    if ($_SESSION["role"] !== $role) {
        header("Location: index.php?error=access_denied");
        exit();
    }
}
?>
