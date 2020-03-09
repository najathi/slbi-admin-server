<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once '../connection/dbh.inc.php';

if (count($_POST) > 0) {
    if (isset($_POST['submitChgPwd'])) {
        $u_id = $_SESSION['U_ID'];
        $cur_pass = mysqli_real_escape_string($conn, $_POST['cur_pass']);
        $hashedCurPass = password_hash($cur_pass, PASSWORD_DEFAULT);
        $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
        $hashedNewPass = password_hash($new_pass, PASSWORD_DEFAULT);
        $con_new_pass = mysqli_real_escape_string($conn, $_POST['con_new_pass']);

        $result = mysqli_query($conn, "SELECT * FROM users_acc WHERE U_ID='" . $u_id . "'");
        $row = mysqli_fetch_array($result);

        if ($new_pass == $con_new_pass) {

            $hashedPwd = password_verify($cur_pass, $row['U_Password']);

            if ($hashedPwd) {
                mysqli_query($conn, "UPDATE users_acc set U_Password='" . $hashedNewPass . "' WHERE U_ID='" . $u_id . "'");
                header("Location: ../../change-password?chg=success");
                exit();
            } else {
                header("Location: ../../change-password?chg=curpwd");
                exit();
            }
        } else {
            header("Location: ../../change-password?chg=pwdmatch");
            exit();

        }
    }
}

