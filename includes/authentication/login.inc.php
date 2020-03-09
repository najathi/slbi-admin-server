<?php

session_start();

if (isset($_POST['submitLogin'])) {
    include_once '../connection/dbh.inc.php';

    $email = mysqli_real_escape_string($conn, $_POST['U_Email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['U_Password']);

    $MM_redirectLoginSuccess = "/";
    $MM_redirectLoginFailed = "../../login?login=error";

    if (empty($email) || empty($pwd)) {
        header("Location: ../../login?login=empty");
        exit();
    } else {
        // check the user
        $sql = "SELECT * FROM users_acc WHERE U_Email='$email';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location: ../../login?login=errorUser");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                // De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $row['U_Password']);
                if (!$hashedPwdCheck) {
                    header("Location: ../../login?login=errorPwd");
                    exit();
                } elseif ($hashedPwdCheck) {
                    // login in the user here
                    $_SESSION['U_ID'] = $row['U_ID'];
                    $_SESSION['Firstname'] = $row['Firstname'];
                    $_SESSION['Lastname'] = $row['Lastname'];
                    $_SESSION['U_Email'] = $row['U_Email'];
                    $_SESSION['PhNo'] = $row['PhNo'];
                    $_SESSION['Gender'] = $row['Gender'];
                    $_SESSION['DTime'] = $row['DTime'];
                    $_SESSION['Image'] = $row['Image'];
                    $_SESSION['user_role_id'] = $row['user_role_id'];
                    $_SESSION['loggedin'] = true;

                    /* $loginFormAction = $_SERVER['PHP_SELF'];
                    if (isset($_GET['accesscheck'])) {
                        $_SESSION['PrevUrl'] = $_GET['accesscheck'];
                    }

                    if (isset($_SESSION['PrevUrl']) && true) {
                        $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
                        header("Location: " . $MM_redirectLoginSuccess);
                    } */

                    header("Location: ../../");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: " . $MM_redirectLoginFailed);
    exit();
}
