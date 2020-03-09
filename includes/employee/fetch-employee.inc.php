<?php
include('../connection/dbh_pdo.inc.php');
$query = '';
$output = array();
$query .= "SELECT * FROM employees ";
if (isset($_POST["search"]["value"])) {
  $query .= 'WHERE id LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR namee LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR address_l_two LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR m_no LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR district LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR sim_no LIKE "%' . $_POST["search"]["value"] . '%" ';
}
if (isset($_POST["order"])) {
  $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
  $query .= 'ORDER BY id DESC ';
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
  $sub_array[] = $row["id"];
  $sub_array[] = $row["namee"];
  $sub_array[] = $row["address_l_two"];
  $sub_array[] = $row["m_no"];
  $sub_array[] = $row["district"];
  $sub_array[] = $row["sim_no"];
  $sub_array[] = '<a style="cursor: pointer;" class="text-secondary viewBtn" id="' . $row['id'] . '" data-toggle="modal tooltip" data-target=".view_employees" data-whatever="' . $row['id'] . '" data-placement="top" title="View"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a style="cursor: pointer;" class="text-secondary editBtn" id="' . $row['id'] . '" data-toggle="modal" data-target="#edit_employees" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a class="text-danger delete" id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>';

  $sub_array[] = '<a href="pdf/pdf_employees?id=' . $row['id'] . '" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['id'] . '" data-placement="top" title="Receipt"><i class="fa fa-print"></i></a>';
  $data[] = $sub_array;
}

$statementExOrder = $connection->prepare("SELECT * FROM employees");
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
