<?php
include('../connection/dbh_pdo.inc.php');
$query = '';
$output = array();
$query .= "SELECT * FROM users_acc ";
if (isset($_POST["search"]["value"])) {
  $query .= 'WHERE U_ID LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR Firstname LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR Lastname LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR U_Email LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR PhNo LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR Gender LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR DTime LIKE "%' . $_POST["search"]["value"] . '%" ';
}
if (isset($_POST["order"])) {
  $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
  $query .= 'ORDER BY U_ID DESC ';
}
if ($_POST["length"] != -1) {
  $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach ($result as $row) {
  $sub_array = array();
  $sub_array[] = $row["Firstname"] . '<br/>' . $row["Lastname"];
  $sub_array[] = $row["U_Email"];
  $sub_array[] = $row["Gender"];
  $sub_array[] = ($row["user_role_id"]) ? 'Administrator' : 'Standard User';
  $sub_array[] = $row["DTime"];
  $sub_array[] = '<a class="text-secondary edit-btn" id="' . $row['U_ID'] . '" data-toggle="modal" data-target="#editModal" style="cursor:pointer;"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;

 <a class="text-danger delete" id="' . $row['U_ID'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>';

  $data[] = $sub_array;
}

$statementExOrder = $connection->prepare("SELECT * FROM users_acc");
$statementExOrder->execute();
$resultExOrder = $statementExOrder->fetchAll();
$numExOrder = $statementExOrder->rowCount();

$output = array(
  "draw"    => intval($_POST["draw"]),
  "recordsTotal"  =>  $filtered_rows,
  "recordsFiltered" => $numExOrder,
  "data"    => $data
);
echo json_encode($output);
