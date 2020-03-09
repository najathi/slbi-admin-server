<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once 'includes/authentication/authenticate.inc.php';
include_once 'includes/authentication/ses_record_set.inc.php';

// a_config.php template file
include('layouts/a_config.php');
$PAGE_TITLE = "My Account";

?>
<!doctype html>
<html class="no-js" lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <?php include('layouts/head-tag-contents.php'); ?>

    <style>

        .border-img{
            background: #000;
            width: inherit;
            height: 50px;
            opacity: 0.8;
            transition: all 1s;
        }

        .list-group{
            font-size: 1.5rem;
        }

    </style>

</head>

<body>
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
                        <h4 class="page-title pull-left">My Account</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="/">Home</a></li>
                            <li><span>My Account</span></li>
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

            if (strpos($fullUrl, "err=usertaken") == true) {
                echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that <b>\'Supplier A/C Code\' field has been already taken.</b>  Try another?
                    </div>';
            } elseif (strpos($fullUrl, "supp=added") == true) {
                echo '<div style="margin-top:1rem;" class="alert alert-success" role="alert">
                    <strong>Well done!</strong> A Record has been Added.
                    </div>';
            } elseif (strpos($fullUrl, "err=try") == true) {
                echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that Record wasn\'t added <b>Try Again</b>  
                    </div>';
            }
            ?>

            <div style="margin-top:1rem;" id="alert-info" role="alert">
            </div>

            <div style="margin-top:1rem;" id="alert-success" role="alert">
            </div>

            <div style="margin-top:1rem;" id="alert-danger" role="alert">
            </div>

            <div style="margin-top:1rem;" id="alert-warning" role="alert">
            </div>

            <div class="row" id="firstDiv">
                <div class="col-lg-12 col-ml-12">
                    <div class="row">
                        <div class="col-lg-3 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-center">
                                        <a data-toggle="modal" data-target="#chgpfl" style="cursor: pointer;"><img
                                             class="img-responsive avatar-view border border-primary mx-auto d-block"
                                             src="<?php echo ($row['Image'] == '') ? 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909__340.png' : 'assets/images/profile/'.$row['Image']; ?>"
                                             alt="Avatar"
                                             title="Change the avatar" onmouseover="openDiv()" onmouseleave="closeDiv()"></a>
                                    <div class="border-img" id="auto-border">
                                        <h5 class="text-center p-lg-2 text-white font-weight-bold">Change Profile</h5>
                                    </div>
                                    <h5 class="text-center mt-3"><?php echo $row['Firstname'] . ' ' . $row['Lastname']; ?></h5>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="pull-right"><a class="btn btn-block btn-sm editBtn" data-toggle="modal" data-target="#myAccInfo"><i class="fas fa-edit fa-2x"></i></a></div>
                                    <ul class="list-group">
                                        <li class="list-group-item"><i class="fas fa-user"></i>
                                            &nbsp;&nbsp;<?php echo $row['Firstname'] . ' ' . $row['Lastname']; ?></li>
                                        <li class="list-group-item"><i class="fas fa-envelope-open-text"></i> &nbsp;&nbsp;<?php echo $row['U_Email']; ?>
                                        </li>
                                        <li class="list-group-item"><i class="fa fa-phone"></i>
                                            &nbsp;&nbsp;<?php echo $row['PhNo']; ?></li>
                                        <li class="list-group-item"><i class="fas fa-genderless"></i>
                                            &nbsp;&nbsp;<?php echo $row['Gender']; ?></li>
                                        <li class="list-group-item"><i class="fas fa-map-marker-alt"></i>
                                            &nbsp;&nbsp;<?php echo $row['U_Address']; ?></li>
                                        <li class="list-group-item"><i class="fas fa-briefcase"></i>
                                            &nbsp;&nbsp;<?php echo $row['Designation']; ?></li>
                                        <li class="list-group-item"><i class="fas fa-user-tag"></i>
                                            &nbsp;&nbsp;<?php echo ($row['user_role_id'] == 1) ? 'Administrator' : 'Standard User'; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Modal My Account -->
                        <div class="modal fade" id="myAccInfo" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">My Account Info</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="updateAcc" method="post" enctype="multipart/form-data">
                                            <div class="form-group mb-4">
                                                <label for="Firstname">First Name</label>
                                                <input type="text" class="form-control" placeholder="First Name" name="Firstname"
                                                       id="Firstname" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="Lastname">Last Name</label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="Lastname"
                                                       id="Lastname" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="U_Email">Email Address</label>
                                                <input type="email" class="form-control" placeholder="Email Address"
                                                       name="U_Email" id="U_Email" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="PhNo">Phone Number</label>
                                                <input type="text" class="form-control" placeholder="Phone Number"
                                                       name="PhNo" id="PhNo" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="Gender">Gender</label>
                                                <select class="custom-select" name="Gender" id="Gender" required>
                                                    <option value="">Open this select menu</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="U_Address">Address</label>
                                                <input type="text" class="form-control" placeholder="Address" name="U_Address"
                                                       id="U_Address" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="Designation">Designation</label>
                                                <input type="text" class="form-control" placeholder="Designation"
                                                       name="Designation" id="Designation" required>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" name="update" id="update" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal My Account -->

                    <!-- Modal Open Change Profile -->
                    <div class="modal fade" id="chgpfl" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">My Account Info</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="updateAcc" method="post" enctype="multipart/form-data">
                                        <!--<div class="form-group mb-4">
                                            <label for="Image">Profile Image</label>
                                            <input type="file" class="form-control" name="Image"
                                                   id="Image" required>
                                        </div>-->

                                        <div class="panel panel-default">
                                            <div class="panel-heading mb-3">Select Profile Image</div>
                                            <div class="panel-body">
                                                <input class="form-control" type="file" name="upload_image" id="upload_image" accept="image/*" />
                                                <br />
                                                <div id="uploaded_image"></div>
                                            </div>
                                        </div>
                                </div

                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="onReload" class="btn btn-secondary" data-dismiss="modal">Close
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Open Change Profile -->


                    <!-- Cropping image modal-->
                    <div id="uploadimageModal" class="modal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Upload & Crop Image</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <div id="image_demo" style="width:350px; margin-top:30px"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-success crop_image align-content-center">Crop & Upload Image</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Cropping image modal-->

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

<?php include("layouts/scripts_files.php"); ?>

<script>

    $(document).ready(function () {

        $('#auto-border').hide();

        function openDiv(){
            let x = document.getElementById("auto-border");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        $( ".avatar-view" ).mouseover(function() {
            openDiv();
        });

        $( ".avatar-view" ).mouseleave(function() {
            openDiv();
        });

        // fetch data to #myAccInfo Modal
        $(document).on('click', '.editBtn', function () {
            $.ajax({
                url: "includes/my-account/fetch-myaccount.inc.php",
                method: "POST",
                dataType: "json",
                success: function (data) {

                    $('#myAccInfo').modal('show');

                    $('#Firstname').val(data.Firstname);
                    $('#Lastname').val(data.Lastname);
                    $('#U_Email').val(data.U_Email);
                    $('#PhNo').val(data.PhNo);
                    $('#Gender').val(data.Gender);
                    $('#U_Address').val(data.U_Address);
                    $('#Designation').val(data.Designation);
                    $('#update').val("Save changes");

                }
            });
        });

        // Edit the record
        $('#updateAcc').on("submit", function (event) {
            event.preventDefault();
            $.ajax({
                url: "includes/my-account/edit-myaccount.inc.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function () {
                    $('#update').val("Saving changes");
                },
                success: function (data) {

                    if(data=='invalid')
                    {
                        $('#alert-danger').show();
                        $('#alert-danger').addClass('alert alert-danger');
                        $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Updated <b>Try Again</b>');
                    }else{
                        $('#updateAcc')[0].reset();
                        $('#myAccInfo').modal('hide');
                        $('#alert-info').show();
                        $('#alert-info').html('<strong>Well done!</strong> A Record has been Updated.');
                        $('#alert-info').addClass('alert alert-info');
                        //$("#firstDiv").load(" #firstDiv");

                        location.reload();
                    }
                },
                error: function (err) {
                    $('#alert-danger').show();
                    $('#alert-danger').addClass('alert alert-danger');
                    $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Updated <b>Try Again</b>');
                }
            });

        });

        // image croppie
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width:200,
                height:200,
                type:'square' //circle
            },
            boundary:{
                width:300,
                height:300
            }
        });

        $('#upload_image').on('change', function(){
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function(event){
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response){
                $.ajax({
                    url:"includes/my-account/upload-img.inc.php",
                    type: "POST",
                    data:{"image": response},
                    success:function(data)
                    {
                        $('#uploadimageModal').modal('hide')
                        $('#uploaded_image').html(data);

                        setTimeout(function () {
                            location.reload();
                        },2000);

                    }
                });
            })
        });

    }); // end of ready function
</script>

</body>

</html>