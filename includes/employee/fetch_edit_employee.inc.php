<?php

include_once '../connection/dbh.inc.php';

if (isset($_POST["id"])) {
  $query = "SELECT * FROM employees WHERE id = '" . $_POST["id"] . "'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);
}
