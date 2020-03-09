<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_POST)) {
    include_once '../connection/dbh.inc.php';

    $output = '';
    $message = '';

    $U_ID = $_SESSION["U_ID"];
    $Firstname = mysqli_real_escape_string($conn, $_POST['Firstname']);
    $Lastname = mysqli_real_escape_string($conn, $_POST['Lastname']);
    $U_Email = mysqli_real_escape_string($conn, $_POST['U_Email']);
    $PhNo = mysqli_real_escape_string($conn, $_POST['PhNo']);
    $Gender = mysqli_real_escape_string($conn, $_POST['Gender']);
    $U_Address = mysqli_real_escape_string($conn, $_POST['U_Address']);
    $Designation = mysqli_real_escape_string($conn, $_POST['Designation']);

    $d = new DateTime('', new DateTimeZone('Asia/Colombo'));
    $U_updated_at = $d->format('Y-m-d H:i:s');

    $query = "UPDATE users_acc
    SET Firstname='$Firstname',   
    Lastname='$Lastname',   
    U_Email = '$U_Email',
    PhNo = '$PhNo',
    Gender = '$Gender',
    U_Address = '$U_Address',
    Designation = '$Designation',
    U_updated_at = '$U_updated_at'
    WHERE U_ID= '$U_ID'";

    $resUpdate = mysqli_query($conn, $query);

    if ($resUpdate) {
        $select_query = "SELECT * FROM users_acc";
        $result = mysqli_query($conn, $select_query);
    }
    else{
        echo 'invalid';
    }
}