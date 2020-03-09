$currentPage = $_SERVER["PHP_SELF"];

// define how many results you want per page
$results_per_page = 10;

// find out the number of results stored in database
$sql="SELECT * FROM customer";
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);

// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;

// retrieve selected results from database and display them on page
//$sql='SELECT * FROM customer LIMIT ' . $this_page_first_result . ',' .  $results_per_page;

if (isset($_POST['CSearch'])) {
    $searchh = mysqli_real_escape_string($conn, $_POST['searchh']);
    $sql_r = "SELECT * FROM customer WHERE cus_ac_code LIKE '%".$searchh."%' OR c_name LIKE '%".$searchh."%' OR tele_no LIKE '%".$searchh."%' OR c_email LIKE '%".$searchh."%' OR c_address LIKE '%".$searchh."%'";
} elseif (empty($_POST['CSearch'])) {
    $sql_r='SELECT * FROM customer';
} else {
    $sql_r='SELECT * FROM customer WHERE cus_ac_code <> "000001"';
}

$sql = sprintf("%s LIMIT %d, %d", $sql_r, $this_page_first_result, $results_per_page);
$result = mysqli_query($conn, $sql);



<!-- Body Part -->
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

                                <div class="col-lg-4 col-md-6 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="header-title">Medium Pagination</div>
                                            <nav aria-label="...">
                                                <ul class="pagination pagination-md">
                                                    
                                <?php
                                     for ($page=1;$page<=$number_of_pages;$page++) {
                                        echo '
                                        <li class="page-item">
                                            <a style="margin-right:0.5rem" class="page-item" href="search-customer.php?page=' . $page . '">' . $page . '</a>
                                        </li>';
                                    }
                                ?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
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