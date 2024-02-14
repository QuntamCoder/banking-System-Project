<?php
// logout.php

// Start or resume the session
session_start();

// Perform logout actions
session_destroy(); // Destroy all data associated with the current session

// Redirect to login page
header('Location: login.php');
exit();
?>
