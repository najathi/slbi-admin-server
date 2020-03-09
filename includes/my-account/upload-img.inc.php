<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once '../connection/dbh.inc.php';

if(isset($_POST["image"]))
{

    $U_ID = $_SESSION['U_ID'];

    $sqlCheckImg = "SELECT * FROM users_acc WHERE U_ID = '$U_ID';";
    $resultCheckImg = mysqli_query($conn,$sqlCheckImg);
    $rowCheckImg = mysqli_fetch_assoc($resultCheckImg);

    if (!$rowCheckImg['Image'] == ''){
        $filePath =  '../../assets/images/profile/'. $rowCheckImg['Image'];
        unlink($filePath);
    }

    $data = $_POST["image"];

    $image_array_1 = explode(";", $data);

    $image_array_2 = explode(",", $image_array_1[1]);

    $data = base64_decode($image_array_2[1]);

    $imageName = time() . '.png';
    //$imageName = $_SESSION['U_ID'] . '.png';
    $fullPath = '../../assets/images/profile/'.$imageName;

    file_put_contents('../../assets/images/profile/'.$imageName, $data);

    $d = new DateTime('', new DateTimeZone('Asia/Colombo'));
    $U_updated_at = $d->format('Y-m-d H:i:s');

    $query = "UPDATE users_acc
    SET Image='$imageName',   
    U_updated_at = '$U_updated_at'
    WHERE U_ID= '$U_ID'";
    mysqli_query($conn,$query);

    echo '<img src="'.$fullPath.'" class="img-thumbnail" />';

}
