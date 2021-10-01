<?php

function check_query($result)
{
    global $conn;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
}

function escape($string){
    global $conn;
    return mysqli_real_escape_string($conn,trim($string));
}

?>