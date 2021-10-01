<?php session_start(); ?>

<?php
session_destroy();

// echo $_SESSION['username'] = null;
// echo $_SESSION['user_image'] = null;
// echo $_SESSION['user_email'] = null;
// echo $_SESSION['user_role'] = null;

header("Location: ../index.php");

?>