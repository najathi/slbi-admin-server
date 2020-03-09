<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once 'includes/connection/dbh.inc.php';
include_once 'includes/authentication/authenticate.inc.php';
include_once 'includes/authentication/ses_record_set.inc.php';

// a_config.php template file
include('layouts/a_config.php');
$PAGE_TITLE = "Change Password";

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
<!-- page container area start -->
<div class="page-container">
    <!-- sidebar menu area start -->
    <div class="sidebar-menu">
        <div class="sidebar-header">
            <?php include("layouts/header-logo.php"); ?>
        </div>
        <?php include("layouts/main_menu.php"); ?>
    </div>
    <!-- sidebar menu area end -->
    <!-- main content area start -->
    <div class="main-content">
        <!-- header area start -->
        <div class="header-area">
            <div class="row align-items-center">
                <!-- nav and search button -->
                <div class="col-md-6 col-sm-8 clearfix">
                    <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                </div>
                <!-- profile info & task notification -->
            </div>
        </div>
        <!-- header area end -->
        <!-- page title area start -->
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">Change Password</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="/">Home</a></li>
                            <li><span>Change Password</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 clearfix">
                    <div class="user-profile pull-right">
                        <?php include("layouts/avatar.php"); ?>
                        <div class="dropdown-menu">
                            <?php include("layouts/drop-down.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page title area end -->
        <div class="main-content-inner">

            <?php

            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if (strpos($fullUrl, "chg=curpwd") == true) {
                echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that <b></b>Current Password is not correct Try Again?
                    </div>';
            } elseif (strpos($fullUrl, "chg=success") == true) {
                echo '<div style="margin-top:1rem;" class="alert alert-success" role="alert">
                    <strong>Well done!</strong> Password Changed.
                    </div>';
            } elseif (strpos($fullUrl, "chg=pwdmatch") == true) {
                echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that Password isn\'t match<b>Try Again</b>  
                    </div>';
            }
            ?>

            <div class="row">
                <div class="col-lg-12 col-ml-12">
                    <div class="row">
                        <!-- Add Customer start -->
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Change Password</h4>
                                    <p class="text-muted font-14 mb-4">Here want to change password of <code>your account</code>.</p>
                                    <form action="includes/authentication/change-pwd.inc.php" method="POST">

                                        <div class="message"><?php if(isset($message)) { echo $message; } ?></div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="cur_pass" class="col-form-label">Current Password</label>
                                                <input type="password" id="cur_pass" name="cur_pass" class="form-control" placeholder="Current Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="new_pass" class="col-form-label">New Password</label>
                                                <input type="password" id="new_pass" name="new_pass" class="form-control" placeholder="New Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="con_new_pass" class="col-form-label">Confirm Password</label>
                                                <input type="password" id="con_new_pass" name="con_new_pass" class="form-control" placeholder="Confirm Password" required>
                                            </div>
                                        </div>

                                        <button style="margin-top: 1rem;" class="btn btn-success btn-md" name="submitChgPwd" type="submit">Change</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Textual inputs end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    <footer>
        <div class="footer-area">
            <?php include("layouts/footer.php"); ?>
        </div>
    </footer>
    <!-- footer area end-->
</div>
<!-- page container area end -->
<!-- offset area start -->
<!-- offset area end -->
<!-- jquery latest version -->
<?php include("layouts/scripts_files.php"); ?>

<script>

    $(document).ready(function(){
        setTimeout(function () {
            window.history.pushState({}, document.title, "/" + "change-password");
            $('.alert').fadeOut("slow");
        },8000);
    });

</script>

</body>

</html>