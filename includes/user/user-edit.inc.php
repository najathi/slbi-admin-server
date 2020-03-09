<?php

if (!empty($_POST)) {
  include_once '../connection/dbh.inc.php';

  $output = '';
  //$message = '';

  $U_ID = mysqli_real_escape_string($conn, $_POST['U_ID']);
  $Firstname = mysqli_real_escape_string($conn, $_POST['Firstnamee']);
  $Lastname = mysqli_real_escape_string($conn, $_POST['Lastnamee']);
  $U_Email = mysqli_real_escape_string($conn, $_POST['U_Emaill']);
  $U_Password = password_hash(mysqli_real_escape_string($conn, $_POST["U_Passwordd"]), PASSWORD_DEFAULT);
  $Gender = mysqli_real_escape_string($conn, $_POST['Genderr']);
  $user_role_id = mysqli_real_escape_string($conn, $_POST['user_role_idd']);

  $d = new DateTime('', new DateTimeZone('Asia/Colombo'));
  $U_updated_at = $d->format('Y-m-d H:i:s');

  $query = "
    UPDATE users_acc   
    SET Firstname='$Firstname',
    Lastname='$Lastname',
    U_Email='$U_Email',
    U_Password='$U_Password',
    Gender='$Gender',
    user_role_id='$user_role_id',
    U_updated_at='$U_updated_at'
    WHERE U_ID= '$U_ID'";

  $resUpdate = mysqli_query($conn, $query);

  if ($resUpdate) {
    $select_query = "SELECT * FROM users_acc";
    $result = mysqli_query($conn, $select_query);

    $output .= '  
              <table style="width:100%" id="userTable" class="table table-hover progress-table text-center">
              <thead class="text-uppercase">                                                
                  <tr>
                      <tr>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Gender</th>
                          <th scope="col">User Type</th>
                          <th scope="col">Date & Time</th>
                          <th scope="col">action</th>
                      </tr>
                  </tr>
              </thead>  
          ';
    while ($row = mysqli_fetch_array($result)) {
      $output .= '  
                  <tbody>
                  <tr>
                      <td scope="row">' . $row['Firstname'] . '<br/>' . $row['Lastname'] . '</td>
                      <td>' . $row['U_Email'] . '</td>
                      <td>' . $row['Gender'] . '</td>
                      <td>' . ($row["user_role_id"]) ? 'Administrator' : 'Standard User' . '</td>
                      <td>' . $row['DTime'] . '</td>
                      <td>' . '<a class="text-secondary edit-btn" id="' . $row['U_ID'] . '" data-toggle="modal" data-target="#editModal" style="cursor:pointer;"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                      <a class="text-danger delete" id="' . $row['U_ID'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>' . '</td>

                  </tr>
                  </tbody>';
    }
    $output .= '</table> ';
  } else {
    $output .= '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that Record wasn\'t updated <b>Try Again</b>  
                    </div>';
  }


  echo $output;
}
