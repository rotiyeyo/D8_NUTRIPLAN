<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Clear the session structure out of running memory completely
    session_destroy();
}

// Route back to the index system landing view with a clean slate
header('Location: signIn.php');
exit;
?>