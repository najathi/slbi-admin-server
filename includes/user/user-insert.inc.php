<?php

include_once '../connection/dbh.inc.php';

$output = '';
$return = [];

if (!empty($_POST)) {

  $Firstname = mysqli_real_escape_string($conn, $_POST["Firstname"]);
  $Lastname = mysqli_real_escape_string($conn, $_POST["Lastname"]);
  $U_Email = mysqli_real_escape_string($conn, $_POST["U_Email"]);
  $U_Password = password_hash(mysqli_real_escape_string($conn, $_POST["U_Password"]), PASSWORD_DEFAULT);
  $Gender = mysqli_real_escape_string($conn, $_POST["Gender"]);
  $user_role_id = mysqli_real_escape_string($conn, $_POST["user_role_id"]);

  // check users again or not
  $sql = "SELECT * FROM users_acc WHERE U_Email='$U_Email'";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);

  if ($resultCheck > 0) {

    echo 'No';
  } else {

    $query = "
        INSERT INTO users_acc(Firstname, Lastname, U_Email, U_Password, Gender, user_role_id)  
         VALUES('$Firstname', '$Lastname', '$U_Email', '$U_Password', '$Gender' , '$user_role_id')
        ";
    //$output['status'] = true;
    //echo 'Yes';

    if (mysqli_query($conn, $query)) {


      $select_query = "SELECT * FROM users_acc";
      $result = mysqli_query($conn, $select_query);
      $output .= '
      <table class="table table-bordered">  
        <tr>  
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>
            <th scope="col">User Type</th>
            <th scope="col">Date & Time</th>
            <th scope="col">action</th>  
        </tr>

     ';
      while ($row = mysqli_fetch_array($result)) {
        $output .= '
       <tr>  
          <td>' . $row["Firstname"] . '<br/>' . $row["Lastname"] . '</td>  
          <td>' . $row["U_Email"] . '</td>  
          <td>' . $row["Gender"] . '</td>  
          <td>' . ($row["user_role_id"]) ? 'Administrator' : 'Standard User' . '</td>  
          <td>' . $row["DTime"] . '</td>  
          <td>
          <a class="text-secondary edit-btn" id="' . $row['U_ID'] . '" data-toggle="modal" data-target="#editModal" style="cursor:pointer;"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
          <a class="text-danger delete" id="' . $row['U_ID'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a> 
      </tr>
      ';
      }
      $output .= '</table>';
    }
  }
  echo 'Yes';
  echo $output;
}
