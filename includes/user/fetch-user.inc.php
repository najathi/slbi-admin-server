<?php
//fetch.php

include_once '../connection/dbh.inc.php';

if (isset($_POST["U_ID"])) {
  $query = "SELECT * FROM users_acc WHERE U_ID = '" . $_POST["U_ID"] . "'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);
}
