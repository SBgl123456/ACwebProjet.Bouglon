<?php
// Start the session to access it
session_start();

// Destroy the session and log the user out
session_destroy();

// Redirect to home page
header("Location: index.php");
exit();
?>
