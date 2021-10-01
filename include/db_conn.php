<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";

DEFINE('DB_HOST',$db['db_host']);
DEFINE('DB_USER',$db['db_user']);
DEFINE('DB_PASS',$db['db_pass']);
DEFINE('DB_NAME',$db['db_name']);

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
if (!$conn) {
    die("Connection not established");
}