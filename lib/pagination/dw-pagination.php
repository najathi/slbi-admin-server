<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once 'includes/dbh.inc.php';
include_once 'includes/authenticate.inc.php';
include_once 'includes/ses_record_set.inc.php';
include_once 'includes/address_divider.inc.php';

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_customer = 10;
$pageNum_customer = 0;
if (isset($_GET['pageNum_customer'])) {
    $pageNum_customer = $_GET['pageNum_customer'];
}
$startRow_customer = $pageNum_customer * $maxRows_customer;

mysqli_select_db($conn, 'tas');
$query_customer = "SELECT * FROM customer";
$query_limit_customer = sprintf("%s LIMIT %d, %d", $query_customer, $startRow_customer, $maxRows_customer);
$customer = mysqli_query($conn, $query_limit_customer) or die(mysqli_error($conn));
$row_customer = mysqli_fetch_assoc($customer);

if (isset($_GET['totalRows_customer'])) {
    $totalRows_customer = $_GET['totalRows_customer'];
} else {
    $all_customer = mysqli_query($conn, $query_customer);
    $totalRows_customer = mysqli_num_rows($all_customer);
}
$totalPages_customer = ceil($totalRows_customer/$maxRows_customer)-1;
$maxRows_customer= 10;
$pageNum_customer = 0;
if (isset($_GET['pageNum_customer'])) {
    $pageNum_customer = $_GET['pageNum_customer'];
}
$startRow_customer = $pageNum_customer * $maxRows_customer;

$maxRows_customer = 10;
$pageNum_customer = 0;
if (isset($_GET['pageNum_customer'])) {
    $pageNum_customer = $_GET['pageNum_customer'];
}
$startRow_customer = $pageNum_customer * $maxRows_customer;

$colname_customer = "-1";

mysqli_select_db($conn, 'tas');

if (isset($_POST['searchh'])) {
    //This only serching records
    $searchh = $_POST['searchh'];
    $query_customer = "SELECT * FROM customer WHERE cus_ac_code LIKE '%".$searchh."%' OR c_name LIKE '%".$searchh."%' OR tele_no LIKE '%".$searchh."%' OR c_email LIKE '%".$searchh."%' OR c_address LIKE '%".$searchh."%'";
} else {
    //this only for all records
    mysqli_select_db($conn, 'tas');
    $query_customer = "SELECT * FROM customer";
}

$query_limit_customer = sprintf("%s LIMIT %d, %d", $query_customer, $startRow_customer, $maxRows_customer);
$customer = mysqli_query($conn, $query_limit_customer) or die(mysql_error());
$row_customer = mysqli_fetch_assoc($customer);

if (isset($_GET['totalRows_customer'])) {
    $totalRows_customer = $_GET['totalRows_customer'];
} else {
    $all_customer = mysqli_query($conn, $query_customer);
    $totalRows_customer = mysqli_num_rows($all_customer);
}
$totalPages_customer = ceil($totalRows_customer/$maxRows_customer)-1;

$queryString_customer = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_customer") == false &&
        stristr($param, "totalRows_customer") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_customer = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_customer = sprintf("&totalRows_customer=%d%s", $totalRows_customer, $queryString_customer);
?>

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
          <div class="search-box pull-left">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <input type="text" name="searchh" placeholder="Search anything"> 
                  <button type="submit" name="CSearch" style="margin-left:0.5rem;" class="btn btn-primary btn-rounded">Search</button>
              </form>
          </div>
      </div>
      <!-- profile info & task notification -->
      <div class="col-md-6 col-sm-4 clearfix">
          <ul class="notification-area pull-right">
              <li id="full-view"><i class="ti-fullscreen"></i></li>
              <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
              <li class="dropdown">
                  <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                      <span>2</span>
                  </i>
                  <div class="dropdown-menu bell-notify-box notify-box">
                      <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                      <div class="nofity-list">
                          <a href="#" class="notify-item">
                              <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                              <div class="notify-text">
                                  <p>You have Changed Your Password</p>
                                  <span>Just Now</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                              <div class="notify-text">
                                  <p>New Commetns On Post</p>
                                  <span>30 Seconds ago</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                              <div class="notify-text">
                                  <p>Some special like you</p>
                                  <span>Just Now</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                              <div class="notify-text">
                                  <p>New Commetns On Post</p>
                                  <span>30 Seconds ago</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                              <div class="notify-text">
                                  <p>Some special like you</p>
                                  <span>Just Now</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                              <div class="notify-text">
                                  <p>You have Changed Your Password</p>
                                  <span>Just Now</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                              <div class="notify-text">
                                  <p>You have Changed Your Password</p>
                                  <span>Just Now</span>
                              </div>
                          </a>
                      </div>
                  </div>
              </li>
              <li class="dropdown">
                  <i class="fa fa-envelope-o dropdown-toggle" data-toggle="dropdown"><span>3</span></i>
                  <div class="dropdown-menu notify-box nt-enveloper-box">
                      <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                      <div class="nofity-list">
                          <a href="#" class="notify-item">
                              <div class="notify-thumb">
                                  <img src="assets/images/author/author-img1.jpg" alt="image">
                              </div>
                              <div class="notify-text">
                                  <p>Aglae Mayer</p>
                                  <span class="msg">Hey I am waiting for you...</span>
                                  <span>3:15 PM</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb">
                                  <img src="assets/images/author/author-img2.jpg" alt="image">
                              </div>
                              <div class="notify-text">
                                  <p>Aglae Mayer</p>
                                  <span class="msg">When you can connect with me...</span>
                                  <span>3:15 PM</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb">
                                  <img src="assets/images/author/author-img3.jpg" alt="image">
                              </div>
                              <div class="notify-text">
                                  <p>Aglae Mayer</p>
                                  <span class="msg">I missed you so much...</span>
                                  <span>3:15 PM</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb">
                                  <img src="assets/images/author/author-img4.jpg" alt="image">
                              </div>
                              <div class="notify-text">
                                  <p>Aglae Mayer</p>
                                  <span class="msg">Your product is completely Ready...</span>
                                  <span>3:15 PM</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb">
                                  <img src="assets/images/author/author-img2.jpg" alt="image">
                              </div>
                              <div class="notify-text">
                                  <p>Aglae Mayer</p>
                                  <span class="msg">Hey I am waiting for you...</span>
                                  <span>3:15 PM</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb">
                                  <img src="assets/images/author/author-img1.jpg" alt="image">
                              </div>
                              <div class="notify-text">
                                  <p>Aglae Mayer</p>
                                  <span class="msg">Hey I am waiting for you...</span>
                                  <span>3:15 PM</span>
                              </div>
                          </a>
                          <a href="#" class="notify-item">
                              <div class="notify-thumb">
                                  <img src="assets/images/author/author-img3.jpg" alt="image">
                              </div>
                              <div class="notify-text">
                                  <p>Aglae Mayer</p>
                                  <span class="msg">Hey I am waiting for you...</span>
                                  <span>3:15 PM</span>
                              </div>
                          </a>
                      </div>
                  </div>
              </li>
              <li class="settings-btn">
                  <i class="ti-settings"></i>
              </li>
          </ul>
      </div>
  </div>
</div>
<!-- header area end -->
<!-- page title area start -->
<div class="page-title-area">
  <div class="row align-items-center">
      <div class="col-sm-6">
          <div class="breadcrumbs-area clearfix">
              <h4 class="page-title pull-left">Search</h4>
              <ul class="breadcrumbs pull-left">
                  <li><a href="index.html">Home</a></li>
                  <li><span>Customer Search</span></li>
              </ul>
          </div>
      </div>
      <div class="col-sm-6 clearfix">
          <div class="user-profile pull-right">
              <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
              <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $row['Lastname']; ?> <i class="fa fa-angle-down"></i></h4>
              <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Message</a>
                  <a class="dropdown-item" href="#">Settings</a>
                  <a class="dropdown-item" href="includes/logout.inc.php">Log Out</a>
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

?>
  <div class="row">                    
      <!-- Progress Table start -->
      <div class="col-12 mt-5">
          <div class="card">
              <div class="card-body">
                  <h4 class="header-title">Customer</h4>
                  <div class="single-table">
                      <div class="table-responsive">

                      
                          <table id="cusTable" class="table table-hover progress-table text-center">
                              <thead class="text-uppercase">
                                  <?php
                                        if ($totalRows_customer > 0) {
                                            ?>
                                  <tr>
                                      <th scope="col">Cus A/C Code</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Phone No.</th>
                                      <th scope="col">Email</th>
                                      <th scope="col">Address</th>
                                      <th scope="col">action</th>
                                  </tr>
                                  <?php
                                        } ?>
                              </thead>

                                  <?php
                                  if ($totalRows_customer > 0) {
                                      while ($rowCus = mysqli_fetch_assoc($customer)) {
                                          ?>
                              <tbody>
                                  <tr>
                                      <td scope="row"><strong><?php echo $rowCus['cus_ac_code']; ?></strong></td>
                                      <td><?php echo $rowCus['c_name']; ?></td>
                                      <td><?php echo $rowCus['tele_no']; ?></td>
                                      <td><?php echo $rowCus['c_email']; ?></td>
                                      <td><?php echo addressDevider($rowCus['c_address']); ?></td>
                                      <td>
                                          <ul class="d-flex justify-content-center">
                                              <li class="mr-3"><a href="" class="text-secondary edit-btn" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a></li>
                                          </ul>
                                      </td>
                                  </tr>
                              </tbody>

                                  <?php
                                      }
                                  } else {
                                      echo "<div class='alert alert-danger' role='alert'>
                                      <strong>Oh snap!</strong> No Records Found !
                                      </div>";
                                  }
                                  ?>

                          </table>

                          <!-- <div class="col-lg-4 col-md-6 mt-5">
                              <div class="card">
                                  <div class="card-body">
                                      <div class="header-title">Medium Pagination</div>
                                      <nav aria-label="...">
                                          <ul class="pagination pagination-md">
                                              
                          <?php
                              /*  for ($page=1;$page<=$number_of_pages;$page++) {
                                  echo '
                                  <li class="page-item">
                                      <a style="margin-right:0.5rem" class="page-item" href="search-customer.php?page=' . $page . '">' . $page . '</a>
                                  </li>';
                              } */
                          ?>
                                          </ul>
                                      </nav>
                                  </div>
                              </div>
                          </div>  -->

                  <div class="tooltip-demo boxpadding">
                    <table>
                      <tr>
                        <td><?php if ($pageNum_customer > 0) { // Show if not first page?>
                            <a href="<?php printf("%s?pageNum_customer=%d%s", $currentPage, 0, $queryString_customer); ?>"><button type="button" class="btn btn-warning style3">First</button></a>
                            <?php } // Show if not first page?></td>
                        <td><?php if ($pageNum_customer > 0) { // Show if not first page?>
                            <a href="<?php printf("%s?pageNum_customer=%d%s", $currentPage, max(0, $pageNum_customer - 1), $queryString_customer); ?>"><button type="button" class="btn btn-warning style3">Previous</button></a>
                            <?php } // Show if not first page?></td>
                        <td><?php if ($pageNum_customer < $totalPages_customer) { // Show if not last page?>
                            <a href="<?php printf("%s?pageNum_customer=%d%s", $currentPage, min($totalPages_customer, $pageNum_customer + 1), $queryString_customer); ?>"><button type="button" class="btn btn-warning style3">Next</button></a>
                            <?php } // Show if not last page?></td>
                        <td><?php if ($pageNum_customer < $totalPages_customer) { // Show if not last page?>
                            <a href="<?php printf("%s?pageNum_customer=%d%s", $currentPage, $totalPages_customer, $queryString_customer); ?>"><button type="button" class="btn btn-warning style3">Last</button></a>
                            <?php } // Show if not last page?></td>
                      </tr>
                      </table>
                      <br/>
                      <p>
                          
                      <b>Total results :</b> <?php echo $totalRows_customer ?><b> From </b><?php echo($startRow_customer + 1) ?><b> To </b><?php echo min($startRow_customer + $maxRows_customer, $totalRows_customer) ?> <br/><?php // Show if recordset not empty?>
                      </p>
                  </div>
                          
                          
                          
                          <!-- Modals -->
                          <!-- Live demo Modal Start -->
                          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <form action="includes/edit-customer.inc.php" method="POST">
                              <div class="modal-body">
                                  <p>                          
                                      <div class="form-group row">
                                          <div class="col-sm-12">
                                              <label for="example-text-input" class="col-form-label">CUS A/C Code ID</label>
                                              <input type="text" readonly="readonly" name="cus_ac_code" id="cus_ac_code" class="form-control">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <div class="col-sm-12">
                                              <label for="example-text-input" class="col-form-label">Name</label>
                                              <input type="text" name="c_name" id="c_name" class="form-control" placeholder="Supplier Name" required>
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <div class="col-sm-12">
                                              <label for="example-text-input" class="col-form-label">Phone No.</label>
                                              <input type="text" name="tele_no" id="tele_no" class="form-control" placeholder="Phone Number">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <div class="col-sm-12">
                                              <label for="example-text-input" class="col-form-label">Email Address</label>
                                              <input type="text" name="c_email" id="c_email" class="form-control" placeholder="Email">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <div class="col-sm-12">
                                              <label for="example-text-input" class="col-form-label">Address</label>
                                              <input type="text" name="c_address" id="c_address"class="form-control" placeholder="Address">
                                          </div>
                                      </div>                                             
                                  </p>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" name="editCustomer" class="btn btn-primary">Update</button>
                              </div>
                              </div> 
                          </form>
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