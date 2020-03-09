<img class="avatar user-thumb" src="<?php echo ($row['Image'] == '') ? 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909__340.png' : 'assets/images/profile/'.$row['Image']; ?>" alt="avatar">
<h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $row['Lastname'];
    ?> <i class="fa fa-angle-down"></i></h4>