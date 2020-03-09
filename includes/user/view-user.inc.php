<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['U_ID'])) {
    include_once '../connection/dbh.inc.php';

    $output = '';
    $query = "SELECT * FROM users_acc WHERE U_ID = '" . $_SESSION['U_ID'] . "'";
    $result = mysqli_query($conn, $query);

    $output .= '
    <div class="row" id="firstDiv">
        <div class="col-lg-12 col-ml-12">
            <div class="row">
    ';

    while ($row = mysqli_fetch_array($result)) {

        $output .= '
        <div class="col-lg-3 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-center">
                                        <a data-toggle="modal" data-target="#chgpfl" style="cursor: pointer;"><img
                                             class="img-responsive avatar-view border border-primary mx-auto d-block"
                                             src="'. ($row['Image'] == '') ? 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909__340.png' : 'assets/images/profile/'.$row['Image'] .'
                                             alt="Avatar">
                                        </a>
                                    <h5 class="text-center mt-3">'.$row['Firstname'] . ' ' . $row['Lastname'].'</h5>
                                    </p>

                                </div>
                            </div>
                        </div>
        ';

    }

    $output .= '
            </div>
        </div>
    </div>
    ';

    echo $output;
}
