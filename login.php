<?php
if (!isset($_SESSION)) {
    session_start();
}

// a_config.php template file
include('layouts/a_config.php');
$PAGE_TITLE = "Login";

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include('layouts/head-tag-contents.php'); ?>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="includes/authentication/login.inc.php" method="POST">
                    <div class="login-form-head">
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in and start managing your Adminisrator</p>
                    </div>
                    <?php

                    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                    if (strpos($fullUrl, "login=empty") == true) {
                        echo '<div style="margin-top:1rem;" class="alert alert-warning" role="alert">
                                <strong>Warning!</strong> Better <b>check yourself</b>, Text fields are empty.
                            </div>';
                    } elseif (strpos($fullUrl, "login=errorUser") == true) {
                        echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                            <strong>Oh snap!</strong> Email Address is wrong.
                            </div>';
                    } elseif (strpos($fullUrl, "login=errorPwd") == true) {
                        echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                            <strong>Oh snap!</strong> Password  doesn\'t match.
                            </div>';
                    } elseif (strpos($fullUrl, "login=error") == true) {
                        echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                            <strong>Oh snap!</strong> Login Failed. Try Again.
                            </div>';
                    } elseif (strpos($fullUrl, "signup=success") == true) {
                        echo '<div style="margin-top:1rem;" class="alert alert-success" role="alert">
                            <strong>Well done!</strong> User Account has been created.
                            </div>';
                    } elseif (strpos($fullUrl, "login=required") == true) {
                        echo '<div style="margin-top:1rem;" class="alert alert-warning" role="alert">
                                <strong>Warning!</strong> You must <b> login </b>first..
                            </div>';
                    }


                    ?>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="U_Email" required>
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="U_Password" required>
                            <i class="ti-lock"></i>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                </div>
                            </div>
                            <!-- <div class="col-6 text-right">
                                <a href="reset-pass">Forgot Password?</a>
                            </div> -->
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" name="submitLogin" type="submit">Login <i class="ti-arrow-right"></i></button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <?php include("layouts/scripts_files.php"); ?>
</body>

</html>