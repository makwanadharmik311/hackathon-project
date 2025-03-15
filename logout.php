<?php
session_start();
session_destroy(); // Destroy session
header("Location: auth.php"); // Redirect to login page
exit();
?>