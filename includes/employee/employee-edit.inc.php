<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_POST)) {
    include_once '../connection/dbh.inc.php';

    $output = '';
    //$message = '';

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $namee = mysqli_real_escape_string($conn, $_POST["e_namee"]);
    $address_l_one = mysqli_real_escape_string($conn, $_POST["e_address_l_one"]);
    $address_l_two = mysqli_real_escape_string($conn, $_POST["e_address_l_two"]);
    $nic_no = mysqli_real_escape_string($conn, $_POST["e_nic_no"]);
    $m_no = mysqli_real_escape_string($conn, $_POST["e_m_no"]);
    $designation = mysqli_real_escape_string($conn, $_POST["e_designation"]);
    $gn_div = mysqli_real_escape_string($conn, $_POST["e_gn_div"]);
    $ds_div = mysqli_real_escape_string($conn, $_POST["e_ds_div"]);
    $district = mysqli_real_escape_string($conn, $_POST["e_district"]);
    $sim_no = mysqli_real_escape_string($conn, $_POST["e_sim_no"]);
    $sim_s_no = mysqli_real_escape_string($conn, $_POST["e_sim_s_no"]);
    $user_id = $_SESSION['U_ID'];

    // Get image name
    $pass_fileName = $_FILES['e_pass_img']['name'];
    $pass_fileExt = explode(".", $pass_fileName);
    $pass_fileActualExt = strtolower(end($pass_fileExt));
    $pass_fileNameFull = uniqid("", true) . '1' . $pass_fileName;

    $nic_f_fileName = $_FILES['e_nic_f_img']['name'];
    $nic_f_fileExt = explode(".", $nic_f_fileName);
    $nic_f_fileActualExt = strtolower(end($fileExt));
    $nic_f_fileNameFull = uniqid("", true) . '2' . $nic_f_fileName;

    $nic_b_fileName = $_FILES['e_nic_b_img']['name'];
    $nic_b_fileExt = explode(".", $nic_b_fileName);
    $nic_b_fileActualExt = strtolower(end($fileExt));
    $nic_b_fileNameFull = uniqid("", true) . '3' . $nic_b_fileName;

    // image file directory
    $target1 = '../../../slbi-admin/assets/images/emp-photo/';
    $target_pass_img = $target1 . basename($pass_fileNameFull);
    $target_nic_f_img = $target1 . basename($nic_f_fileNameFull);
    $target_nic_b_img = $target1 . basename($nic_b_fileNameFull);

    // delete already exist file
//    $select_query_file = "SELECT * FROM employees WHERE id = '$id'";
//    $result_file = mysqli_query($conn, $select_query_file);
//    $row_file = mysqli_fetch_array($result);
//
//    if (file_exists($target . $row_file['nic_f_img']) && $target . $row_file['nic_b_img']){
//        unlink($target . $row_file['nic_f_img']);
//        unlink($target . $row_file['nic_b_img']);
//    }

    // Compress Image
    compressedImage($_FILES['e_pass_img']['tmp_name'], $target_pass_img, 60);
    compressedImage($_FILES['e_nic_f_img']['tmp_name'], $target_nic_f_img, 60);
    compressedImage($_FILES['e_nic_b_img']['tmp_name'], $target_nic_b_img, 60);

    // move_uploaded_file($_FILES['e_nic_f_img']['tmp_name'], $target_nic_f_img);
    // move_uploaded_file($_FILES['e_nic_b_img']['tmp_name'], $target_nic_b_img);

    $d = new DateTime('', new DateTimeZone('Asia/Colombo'));
    $updated_at = $d->format('Y-m-d H:i:s');
    echo $updated_at;

    $query = "UPDATE employees SET namee = '$namee', address_l_one = '$address_l_one', address_l_two = '$address_l_two', nic_no = '$nic_no', pass_img ='$pass_fileNameFull', nic_f_img = '$nic_f_fileNameFull', nic_b_img = '$nic_b_fileNameFull', m_no = '$m_no', designation = '$designation', gn_div = '$gn_div', ds_div = '$ds_div', district = '$district', sim_no = '$sim_no', sim_s_no = '$sim_s_no', user_id = '$user_id', updated_at = '$updated_at' WHERE id = '$id'";

//  echo $query;

    $resUpdate = mysqli_query($conn, $query);
//    echo $resUpdate;

    if ($resUpdate) {

        $select_query = "SELECT * FROM employees";
        $result = mysqli_query($conn, $select_query);

        $output .= '
              <table id="ex-order-table" class="table table-hover progress-table text-center">
              <thead class="text-uppercase">
                  <tr>  
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address Line 2</th>
                    <th scope="col">Mobile No.</th>
                    <th scope="col">District</th>
                    <th scope="col">Pro. Sim No.</th>
                    <th scope="col">action</th>
                    <th scope="col">print</th>  
                  </tr>
              </thead>
          ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
                    <tbody>
                    <tr>
                        <td scope="row"><strong>' . $row['id'] . '</strong></td>
                        <td>' . $row["namee"] . '</td>  
                        <td>' . $row["address_l_two"] . '</td>  
                        <td>' . $row["m_no"] . '</td>  
                        <td>' . $row["district"] . '</td>  
                        <td>' . $row["sim_no"] . '</td>  
                        <td>
                        <a style="cursor: pointer;" class="text-secondary viewBtn" id="' . $row['id'] . '" data-toggle="modal tooltip" data-target=".view_employees" data-whatever="' . $row['id'] . '" data-placement="top" title="View"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a style="cursor: pointer;" class="text-secondary editBtn" id="' . $row['id'] . '" data-toggle="modal" data-target="#edit_employees" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a class="text-danger delete" id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>
                        </td>
                        
                        <td>
                        <a href="pdf/pdf_employees?id=' . $row['id'] . '" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['id'] . '" data-placement="top" title="Receipt"><i class="fa fa-print"></i></a>
                        </td>
                    </tr>
                  </tbody>
              ';
        }
        $output .= '</table> ';
    } else {
        $output .= 'error';
    }

    echo $output;
}

// Compress image
function compressedImage($source, $path, $quality)
{

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $path, $quality);

}
