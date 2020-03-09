<?php

include('../connection/dbh_pdo.inc.php');

if (isset($_POST["id"])) {
  $statement = $connection->prepare(
    "DELETE FROM employees WHERE id = :id"
  );
  $result = $statement->execute(
    array(
      ':id' => $_POST["id"]
    )
  );
}
