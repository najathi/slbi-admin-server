<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once '../connection/dbh.inc.php';

if (!empty($_POST)) {

    $namee = mysqli_real_escape_string($conn, $_POST["namee"]);
    $address_l_one = mysqli_real_escape_string($conn, $_POST["address_l_one"]);
    $address_l_two = mysqli_real_escape_string($conn, $_POST["address_l_two"]);
    $nic_no = mysqli_real_escape_string($conn, $_POST["nic_no"]);
    $m_no = mysqli_real_escape_string($conn, $_POST["m_no"]);
    $designation = mysqli_real_escape_string($conn, $_POST["designation"]);
    $gn_div = mysqli_real_escape_string($conn, $_POST["gn_div"]);
    $ds_div = mysqli_real_escape_string($conn, $_POST["ds_div"]);
    $district = mysqli_real_escape_string($conn, $_POST["district"]);
    $sim_no = mysqli_real_escape_string($conn, $_POST["sim_no"]);
    $sim_s_no = mysqli_real_escape_string($conn, $_POST["sim_s_no"]);
    $user_id = $_SESSION['U_ID'];

    // Get image name
    $pass_fileName = $_FILES['pass_img']['name'];
    $pass_fileExt = explode(".", $pass_fileName);
    $pass_fileActualExt = strtolower(end($pass_fileExt));
    $pass_fileNameFull = uniqid("", true) . '1' . $pass_fileName;

    $nic_f_fileName = $_FILES['nic_f_img']['name'];
    $nic_f_fileExt = explode(".", $nic_f_fileName);
    $nic_f_fileActualExt = strtolower(end($fileExt));
    $nic_f_fileNameFull = uniqid("", true) . '2' . $nic_f_fileName;

    $nic_b_fileName = $_FILES['nic_b_img']['name'];
    $nic_b_fileExt = explode(".", $nic_b_fileName);
    $nic_b_fileActualExt = strtolower(end($fileExt));
    $nic_b_fileNameFull = uniqid("", true) . '3' . $nic_b_fileName;

    // image file directory
    $target_pass_img = "../../assets/images/pass-photo/" . basename($pass_fileNameFull);
    $target_nic_f_img = "../../assets/images/nic-photo/" . basename($nic_f_fileNameFull);
    $target_nic_b_img = "../../assets/images/nic-photo/" . basename($nic_b_fileNameFull);

//    move_uploaded_file($_FILES['pass_img']['tmp_name'], $target_pass_img);
//    move_uploaded_file($_FILES['nic_f_img']['tmp_name'], $target_nic_f_img);
//    move_uploaded_file($_FILES['nic_b_img']['tmp_name'], $target_nic_b_img);

    // Compress Image
    compressedImage($_FILES['pass_img']['tmp_name'], $target_pass_img, 60);
    compressedImage($_FILES['nic_f_img']['tmp_name'], $target_nic_f_img, 60);
    compressedImage($_FILES['nic_b_img']['tmp_name'], $target_nic_b_img, 60);

    $query = "
    INSERT INTO employees(namee, address_l_one, address_l_two, nic_no, pass_img, m_no, designation, gn_div, ds_div, district, nic_f_img, nic_b_img, sim_no, sim_s_no, user_id)  
     VALUES('$namee', '$address_l_one', '$address_l_two', '$nic_no', '$pass_fileNameFull', '$m_no', '$designation', '$gn_div', '$ds_div', '$district', '$nic_f_fileNameFull', '$nic_b_fileNameFull', '$sim_no', '$sim_s_no', '$user_id')";

    if (mysqli_query($conn, $query)) {
        $output .= '<label class="text-success">Data Inserted</label>';
        $select_query = "SELECT * FROM employees ORDER BY id DESC";
        $result = mysqli_query($conn, $select_query);
        $output .= '
      <table class="table table-bordered">  
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

     ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
       <tr>  
            <td>' . $row["id"] . '</td>  
            <td>' . $row["namee"] . '</td>  
            <td>' . $row["address_l_two"] . '</td>  
            <td>' . $row["m_no"] . '</td>  
            <td>' . $row["district"] . '</td>  
            <td>' . $row["sim_no"] . '</td>  
            <td>
            <a style="cursor: pointer;" class="text-secondary viewBtn" id="' . $row['id'] . '" data-toggle="modal tooltip" data-target=".viewOrder" data-whatever="' . $row['id'] . '" data-placement="top" title="View"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a style="cursor: pointer;" class="text-secondary editBtn" id="' . $row['id'] . '" data-toggle="modal" data-target="#editReceipt" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a class="text-danger delete" id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>
            </td>
            
            <td>
            <a href="pdf/pdf_employees?id=' . $row['id'] . '" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['id'] . '" data-placement="top" title="Receipt"><i class="fa fa-print"></i></a>
            </td>  
      </tr>
      ';
        }
        $output .= '</table>';
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
