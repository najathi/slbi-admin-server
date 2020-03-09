<?php

include_once '../connection/dbh.inc.php';

if (isset($_POST["id"])) {
  $query = "SELECT * FROM sim_details WHERE id = '" . $_POST["id"] . "'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);
}
