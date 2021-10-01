<?php ob_start(); ?>
<?php session_start(); ?>

<!-- DATABASE CONNECTION -->
<?php include "../include/db_conn.php"; ?>

<!-- FUNCTION -->
<?php include "./function.php"; ?>

<?php

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== "author") {
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Author Panel</title>

    <link href="../css/styles.css" rel="stylesheet">

    <link href="../fontawesome/css/all.css" rel="stylesheet" type="text/css">
    <script src="../fontawesome/js/all.js"></script>

    <script src="../js/scripts.js"></script>
    <script src="../js/ckeditor.js"></script>

    <style>
        img[alt="user_image"] {
            object-position: top;
            object-fit: cover;
        }

        .ck-editor__editable {
            min-height: 350px;
        }
    </style>

</head>

<body class="sb-nav-fixed">