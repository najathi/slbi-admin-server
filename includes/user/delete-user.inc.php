<?php

include('../connection/dbh_pdo.inc.php');

if (isset($_POST["U_ID"])) {
  $statement = $connection->prepare(
    "DELETE FROM users_acc WHERE U_ID = :id"
  );
  $result = $statement->execute(
    array(
      ':id' => $_POST["U_ID"]
    )
  );
}
