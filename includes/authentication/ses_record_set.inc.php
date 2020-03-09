<?php

include_once 'includes/connection/dbh.inc.php';

// Record Set
$email = $_SESSION['U_Email'];
$sql = "SELECT * FROM users_acc WHERE U_Email='$email';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
