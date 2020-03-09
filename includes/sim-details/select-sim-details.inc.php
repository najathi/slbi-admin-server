<?php
if (isset($_POST["id"])) {
    include_once '../connection/dbh.inc.php';

    $output = '';
    $query = "SELECT * FROM `sim_details` WHERE id = '" . $_POST["id"] . "'";
    $result = mysqli_query($conn, $query);
    $output .= '<div class="card">
                  <div class="card-body">
                  <div id="accordion4" class="according gradiant-bg">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
        <div class="card">
              <div class="card-header">
                    <a class="card-link" data-toggle="collapse">Sim Details Information</a>
              </div>
              <div class="collapse show" data-parent="#accordion1">
                    <div class="card-body">
                    <table class="table table-bordered">
                          <tr>  
                                <td width="30%"><label>Sim Details Id</label></td>  
                                <td width="70%">' . $row["id"] . '</td>  
                          </tr>  
                          <tr>  
                                <td width="30%"><label>Full Name</label></td>  
                                <td width="70%">' . $row["namee"] . '</td>  
                          </tr>  
                          <tr>  
                                <td width="30%"><label>Address</label></td>  
                                <td width="70%">' . $row["address_l_one"] . ' <br/> ' . $row["address_l_two"] . '</td>  
                          </tr>  
                          <tr>  
                                <td width="30%"><label>NIC No</label></td>  
                                <td width="70%">' . $row["nic_no"] . '</td>  
                          </tr>
                          <tr>  
                                <td width="30%"><label>Designation</label></td>  
                                <td width="70%">' . $row["designation"] . '</td>  
                          </tr>
                          <tr>  
                                <td width="30%"><label>GN Division</label></td>  
                                <td width="70%">' . $row["gn_div"] . '</td>  
                          </tr>
                          <tr>  
                                <td width="30%"><label>DS Division</label></td>  
                                <td width="70%">' . $row["ds_div"] . '</td>  
                          </tr>
                          <tr>  
                                <td width="30%"><label>District</label></td>  
                                <td width="70%">' . $row["district"] . '</td>  
                          </tr>
                          <tr>  
                                <td width="30%"><label>Provided Sim Number</label></td>  
                                <td width="70%">' . $row["sim_no"] . '</td>  
                          </tr>
                          <tr>  
                                <td width="30%"><label>Provided Sim Serial Number</label></td>  
                                <td width="70%">' . $row["sim_s_no"] . '</td>  
                          </tr>
                          <tr>  
                                <td width="30%"><label>Created by user</label></td>  
                                <td width="70%">' . $row["user_id"] . '</td>  
                          </tr>
                          <tr>  
                                <td width="30%"><label>Updated At</label></td>  
                                <td width="70%">' . $row["updated_at"] . '</td>  
                          </tr>
                    </table>
                    </div>
           
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <img src="assets/images/nic-photo/' . $row["nic_f_img"] . '" width="250px" height="250px" class="img-fluid mt-3">
                            <p class="mb-3 card-text">NIC Front Image</p>
                        </div>
                        <div class="col-md-6 text-center mb-3 img-fluid">
                            <img src="assets/images/nic-photo/' . $row["nic_b_img"] . '" width="250px" height="250px" class="img-fluid mt-3">
                            <p class="mb-3 card-text">NIC Back Image</p>
                        </div>
                    </div>
              </div>
        </div>\';               
      ';
    }
    $output .= '</div>
        </div>
    </div> ';
    echo $output;
}
