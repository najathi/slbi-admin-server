<?php

if (isset($_POST["submitRegister"])) {
    include_once "../connection/dbh.inc.php";

    $first = mysqli_real_escape_string($conn, $_POST['Firstname']);
    $last = mysqli_real_escape_string($conn, $_POST['Lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['U_Email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['U_Password']);
    $c_pwd = mysqli_real_escape_string($conn, $_POST['C_U_Password']);
    $phNo = mysqli_real_escape_string($conn, $_POST['PhNo']);
    $gender = mysqli_real_escape_string($conn, $_POST['Gender']);

    if (empty($first) || empty($last) || empty($email) || empty($pwd) || empty($c_pwd) || empty($phNo) || empty($gender)) {
        header("Location: ../../register?signup=empty");
        exit();
    } else {
        // check if input characters are valid
        if (!preg_match("/^[a-zA-z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
            header("Location: ../../register?signup=invalid");
            exit();
        } else {
            // check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../../register?signup=email");
                exit();
            } else {
                // check pwd field and confirm pwd field
                if ($pwd != $c_pwd) {
                    header("Location: ../../register?signup=pwdinvalid");
                    exit();
                } else {
                    // check users again or not
                    $sql = "SELECT * FROM users_acc WHERE U_Email='$email'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        header("Location: ../../register?signup=usertaken");
                        exit();
                    } else {
                        // Hashing password
                        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                        // insert the user into database
                        $sql = "INSERT INTO users_acc(Firstname, Lastname, U_Email, U_Password, PhNo, Gender) VALUES('$first','$last','$email','$hashedPwd','$phNo','$gender');";
                        mysqli_query($conn, $sql);

                        header("Location: ../../login?signup=success");
                        exit();
                    }
                }
            }
        }
    }
} else {
    header("Location: ../../register");
    exit();
}
