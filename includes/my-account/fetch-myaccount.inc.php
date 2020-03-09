<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once '../connection/dbh.inc.php';

if (isset($_SESSION["U_ID"])) {
    $query = "SELECT * FROM users_acc WHERE U_ID = '".$_SESSION["U_ID"]."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}