<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once 'includes/connection/dbh.inc.php';
include_once 'includes/authentication/authenticate.inc.php';
include_once 'includes/authentication/ses_record_set.inc.php';

// a_config.php template file
include('layouts/a_config.php');
$PAGE_TITLE = "Employee";

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include('layouts/head-tag-contents.php'); ?>

    <style>
        .img-fluid{
            width: 100%;
            object-fit: cover;
            height: 250px; /* only if you want fixed height */
        }
    </style>

</head>

<body>
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
                            <h4 class="page-title pull-left">Employee</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="/">Home</a></li>
                                <li><span>Add or Search Employee</span></li>
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

                if (strpos($fullUrl, "cus=updated") == true) {
                    echo '<div style="margin-top:1rem;" class="alert alert-success" role="alert">
                    <strong>Well done!</strong> A Record has been Updated.
                    </div>';
                } elseif (strpos($fullUrl, "err=try") == true) {
                    echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that Record wasn\'t added <b>Try Again</b>
                    </div>';
                }

                if (isset($resUpdate)) {
                    $output .= '<div style="margin-top:1rem;" class="alert alert-success" role="alert"> <strong>Well done!</strong>' . $message . '</div>';
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

                <!-- Display status message -->
                <?php if (!empty($statusMsg) && ($statusMsgType == 'success')) { ?>
                    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
                <?php } elseif (!empty($statusMsg) && ($statusMsgType == 'error')) { ?>
                    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
                <?php } ?>

                <!-- Progress Table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Employee</h4>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_employees" title="Add Reciept">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>

                            <div class="single-table">
                                <div class="table-responsive">
                                    <a style="cursor:pointer;" id="onDivRef" onclick="onDivRefresh()"><i class="fa fa-refresh"></i></a>
                                    <table style="width:100%" id="employees-table" class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                            <tr style="background:#000000; color:#fff; margin-top:1rem;">
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
                                    </table>

                                    <!-- Modals -->

                                    <!-- Add Receipt Model -->
                                    <div class="modal fade bd-example-modal-lg" id="add_employees" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" id="insert_form" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="namee">Full Name <span style="color:red; font-size:1rem;">*</span></label>
                                                            <input type="text" class="form-control" placeholder="Full Name" required name="namee" id="namee">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address_l_one">Address <span style="color:red; font-size:1rem;">*</span></label>
                                                            <input type="text" class="form-control" placeholder="Address Line 1" required name="address_l_one" id="address_l_one">
                                                            <input type="text" class="form-control" placeholder="Address Line 2" required name="address_l_two" id="address_l_two">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nic_no">NIC No <span style="color:red; font-size:1rem;">*</span></label>
                                                            <input type="text" class="form-control" placeholder="NIC No" required name="nic_no" id="nic_no">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="m_no">Mobile Number <span style="color:red; font-size:1rem;">*</span></label>
                                                            <input type="tel" class="form-control" placeholder="Mobile Number" required name="m_no" id="m_no">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="designation">Designation <span style="color:red; font-size:1rem;">*</span></label>
                                                            <select class="form-control" name="designation" id="designation" required>
                                                                <option value="">Select Designation</option>
                                                                <option value="Director">Director</option>
                                                                <option value="Director">Associate Director</option>
                                                                <option value="District Manager">District Manager</option>
                                                                <option value="District Manager">Associate District Manager</option>
                                                                <option value="Area Manager">Area Manager</option>
                                                                <option value="Area Manager">Associate Manager</option>
                                                                <option value="Business Consultant">Business Consultant</option>
                                                                <option value="Online Seller">Online Seller</option>
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 col-lg-6 mb-3">
                                                                <label for="gn_div">GN Division <span style="color:red; font-size:1rem;">*</span></label>
                                                                <input type="text" class="form-control" placeholder="GN Division" required name="gn_div" id="gn_div">
                                                            </div>
                                                            <div class="col-sm-6 col-lg-6 mb-3">
                                                                <label for="ds_div">DS Division <span style="color:red; font-size:1rem;">*</span></label>
                                                                <input type="text" class="form-control" placeholder="DS Division" required name="ds_div" id="ds_div">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="district">District <span style="color:red; font-size:1rem;">*</span></label>
                                                            <select class="form-control" name="district" id="district" required>
                                                                <option value="">Select District</option>
                                                                <option value="Ampara">Ampara</option>
                                                                <option value="Anuradhapura">Anuradhapura</option>
                                                                <option value="Badulla">Badulla</option>
                                                                <option value="Batticaloa">Batticaloa</option>
                                                                <option value="Colombo">Colombo</option>
                                                                <option value="Galle">Galle</option>
                                                                <option value="Gampaha">Gampaha</option>
                                                                <option value="Hambantota">Hambantota</option>
                                                                <option value="Jaffna">Jaffna</option>
                                                                <option value="Kalutara">Kalutara</option>
                                                                <option value="Kandy">Kandy</option>
                                                                <option value="Kegalle">Kegalle</option>
                                                                <option value="Kilinochchi">Kilinochchi</option>
                                                                <option value="Kurunegala">Kurunegala</option>
                                                                <option value="Mannar">Mannar</option>
                                                                <option value="Matale">Matale</option>
                                                                <option value="Matara">Matara</option>
                                                                <option value="Moneragala">Moneragala</option>
                                                                <option value="Mullaitivu">Mullaitivu</option>
                                                                <option value="Nuwara">Nuwara</option>
                                                                <option value="Polonnaruwa">Polonnaruwa</option>
                                                                <option value="Puttalam">Puttalam</option>
                                                                <option value="Ratnapura">Ratnapura</option>
                                                                <option value="Trincomalee">Trincomalee</option>
                                                                <option value="Vavuniya">Vavuniya</option> <span style="color:red; font-size:1rem;">*</span>
                                                            </select>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-6 col-lg-6 mb-3">
                                                                <label for="nic_f_img">NIC Front Image <span style="color:red; font-size:1rem;">*</span></label>
                                                                <input type="file" accept="image/*" name="nic_f_img" id="nic_f_img" required>
                                                            </div>
                                                            <div class="col-sm-6 col-lg-6 mb-3">
                                                                <label for="nic_b_img">NIC Back Image <span style="color:red; font-size:1rem;">*</span></label>
                                                                <input type="file" name="nic_b_img" id="nic_b_img" accept="image/*" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pass_img">Passport size photo <span style="color:red; font-size:1rem;">*</span></label><br/>
                                                            <input type="file" accept="image/*" name="pass_img" id="pass_img" class="mb-1" required>
                                                            <p id="sizePass"></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sim_no">Provided Sim Number</label>
                                                            <input type="tel" class="form-control" placeholder="Provided Sim Number" name="sim_no" id="sim_no">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sim_s_no">Provided Sim Serial number</label>
                                                            <input type="text" class="form-control" placeholder="Provided Sim Serial number" name="sim_s_no" id="sim_s_no">
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" id="insert" name="insert" value="Insert" class="btn btn-primary">
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  End Add Receipt Model   -->

                                    <!-- Large modal -->
                                    <div id="viewData" class="modal fade view_employees">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">View - Employee</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="employees_view">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Large modal modal end -->

                                    <!-- Edit Receipt Model -->
                                    <div class="modal fade bd-example-modal-lg" id="edit_employees" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" id="update_form" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="id">Employee ID</label>
                                                            <input type="text" class="form-control" required name="id" id="id" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="e_namee">Full Name <span style="color:red; font-size:1rem;">*</span></label>
                                                            <input type="text" class="form-control" placeholder="Full Name" required name="e_namee" id="e_namee">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address_l_one">Address <span style="color:red; font-size:1rem;">*</span></label>
                                                            <input type="text" class="form-control" placeholder="Address Line 1" required name="e_address_l_one" id="e_address_l_one">
                                                            <input type="text" class="form-control" placeholder="Address Line 2" required name="e_address_l_two" id="e_address_l_two">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="e_nic_no">NIC No <span style="color:red; font-size:1rem;">*</span></label>
                                                            <input type="text" class="form-control" placeholder="NIC No" required name="e_nic_no" id="e_nic_no">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="e_m_no">Mobile Number <span style="color:red; font-size:1rem;">*</span></label>
                                                            <input type="tel" class="form-control" placeholder="Mobile Number" required name="e_m_no" id="e_m_no">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="e_designation">Designation <span style="color:red; font-size:1rem;">*</span></label>
                                                            <select class="form-control" name="e_designation" id="e_designation" required>
                                                                <option value="">Select Designation</option>
                                                                <option value="Director">Director</option>
                                                                <option value="Director">Associate Director</option>
                                                                <option value="District Manager">District Manager</option>
                                                                <option value="District Manager">Associate District Manager</option>
                                                                <option value="Area Manager">Area Manager</option>
                                                                <option value="Area Manager">Associate Manager</option>
                                                                <option value="Business Consultant">Business Consultant</option>
                                                                <option value="Online Seller">Online Seller</option>
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 col-lg-6 mb-3">
                                                                <label for="e_gn_div">GN Division <span style="color:red; font-size:1rem;">*</span></label>
                                                                <input type="text" class="form-control" placeholder="GN Division" required name="e_gn_div" id="e_gn_div">
                                                            </div>
                                                            <div class="col-sm-6 col-lg-6 mb-3">
                                                                <label for="e_ds_div">DS Division <span style="color:red; font-size:1rem;">*</span></label>
                                                                <input type="text" class="form-control" placeholder="DS Division" required name="e_ds_div" id="e_ds_div">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="e_district">District <span style="color:red; font-size:1rem;">*</span></label>
                                                            <input type="text" class="form-control" placeholder="District" required name="e_district" id="e_district">
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-6 col-lg-6 mb-3">
                                                                <label for="e_nic_f_img">NIC Front Image</label>
                                                                <input type="file" accept="image/*" name="e_nic_f_img" id="e_nic_f_img">
                                                            </div>
                                                            <div class="col-sm-6 col-lg-6 mb-3">
                                                                <label for="e_nic_b_img">NIC Back Image</label>
                                                                <input type="file" name="e_nic_b_img" id="e_nic_b_img" accept="image/*">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="e_pass_img">Passport size photo</label><br/>
                                                            <input type="file" accept="image/*" name="e_pass_img" id="e_pass_img" class="mb-1">
                                                            <p id="sizePass"></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="e_sim_no">Provided Sim Number</label>
                                                            <input type="tel" class="form-control" placeholder="Provided Sim Number" name="e_sim_no" id="e_sim_no">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="e_sim_s_no">Provided Sim Serial number</label>
                                                            <input type="text" class="form-control" placeholder="Provided Sim Serial number" name="e_sim_s_no" id="e_sim_s_no">
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" id="update" name="update" value="Update" class="btn btn-primary">
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  End Edit Receipt Model   -->

                                    <!-- Live demo Modal Start -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Conformation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>

                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="editCustomer" class="btn btn-primary">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Live demo Modal End -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Progress Table end -->
            </div>
        </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    <footer>
        <?php include("layouts/footer.php"); ?>
    </footer>
    <!-- footer area end-->
    </div>
    <!-- page container area end -->

    <?php include("layouts/scripts_files.php"); ?>

    <!-- Edit Records -->
    <script>
        $(document).ready(function() {

            // add receipt data
            $('#insert_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "includes/employee/employee-insert.inc.php",
                    type: "POST",
                    data: new FormData(this),
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#insert').val("Inserting");
                    },
                    success: function(data) {
                        $('#insert_form')[0].reset();
                        $('#add_employees').modal('hide');
                        dataTable.ajax.reload(null, false);
                        $('#alert-success').show();
                        $('#alert-success').html('<strong>Well done!</strong> A Record has been Added.');
                        $('#alert-success').addClass('alert alert-info');
                    },
                    error: function(err) {
                        $('#alert-danger').show();
                        $('#alert-danger').addClass('alert alert-danger');
                        $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Added <b>Try Again</b>');
                    }
                });

            });

            $(document).on('click', '.editBtn', function() {
                var id = $(this).attr("id");
                $.ajax({
                    url: "includes/employee/fetch_edit_employee.inc.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        // console.log(data);

                        $('#e_namee').val(data.namee);
                        $('#e_address_l_one').val(data.address_l_one);
                        $('#e_address_l_two').val(data.address_l_two);
                        $('#e_nic_no').val(data.nic_no);
                        $('#e_m_no').val(data.m_no);
                        $('#e_designation').val(data.designation);
                        $('#e_gn_div').val(data.gn_div);
                        $('#e_ds_div').val(data.ds_div);
                        $('#e_district').val(data.district);
                        $('#e_sim_no').val(data.sim_no);
                        $('#e_sim_s_no').val(data.sim_s_no);
                        $('#id').val(data.id);
                        $('#update').val("Update");

                        $('#edit_employees').modal('show');
                    }
                });
            });

            // Edit the record
            $('#update_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "includes/employee/employee-edit.inc.php",
                    type: "POST",
                    data: new FormData(this),
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#update').val("Updating");
                    },
                    success: function(data) {

                        console.log(data);

                        $('#update_form')[0].reset();
                        $('#edit_employees').modal('hide');
                        dataTable.ajax.reload(null, false);

                        if(data == 'error'){
                            $('#alert-danger').addClass('alert alert-danger');
                            $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Updated <b>Try Again</b>');
                            $('#alert-danger').show().fadeIn();
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 8000);
                        }else{
                            $('#alert-info').html('<strong>Well done!</strong> A Record has been Updated.');
                            $('#alert-info').addClass('alert alert-info');
                            $('#alert-info').show().fadeIn();
                            setTimeout(function() {
                                $('#alert-info').fadeOut("slow");
                            }, 8000);
                        }

                    },
                    error: function(err) {
                        $('#alert-danger').addClass('alert alert-danger');
                        $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Updated <b>Try Again</b>');
                        $('#alert-danger').show().fadeIn();
                        setTimeout(function() {
                            $('#alert-danger').fadeOut("slow");
                        }, 8000);
                    }
                });

            });

            // fetch data to #viewData Modal
            $(document).on('click', '.viewBtn', function() {
                var id = $(this).attr("id");
                if (id != '') {
                    $.ajax({
                        url: "includes/employee/select-employee.inc.php",
                        method: "POST",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $('#employees_view').html(data);
                            $('#viewData').modal('show');
                        }
                    });
                }
            });

            // delete the record
            $(document).on('click', '.delete', function() {
                var id = $(this).attr("id");
                if (confirm("Are you sure you want to delete this?")) {
                    $.ajax({
                        url: "includes/employee/delete-employee.inc.php",
                        method: "POST",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            dataTable.ajax.reload(null, false);
                            $('#alert-warning').html('<strong>OHhhh!</strong> A Record has been Deleted.');
                            $('#alert-warning').addClass('alert alert-warning');
                            $('#alert-warning').show().fadeIn();
                            setTimeout(function() {
                                $('#alert-warning').fadeOut("slow");
                            }, 8000);
                        },
                        error: function(err) {
                            $('#alert-danger').addClass('alert alert-danger');
                            $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Deleted <b>Try Again</b>');
                            $('#alert-danger').show().fadeIn();
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 8000);
                        }
                    });
                } else {
                    return false;
                }
            });


            // data table
            var dataTable = $('#employees-table').DataTable({
                language: {
                    searchPlaceholder: "Search Details"
                },
                "sScrollX": "1000%",
                "processing": true,
                "serverSide": true,
                "order": [],
                "autoWidth": false,
                "ajax": {
                    url: "includes/employee/fetch-employee.inc.php",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 6, 7],
                    "orderable": false,
                }, ]
            });

            // refresh button
            $(document).on('click', '#onDivRef', function() {
                dataTable.ajax.reload();
                $('#alert-warning').hide();
                $('#alert-danger').hide();
                $('#alert-success').hide();
                $('#alert-info').hide();
            });

        }); // end of ready function
    </script>

    <script>
        // tooltip
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
</body>

</html>