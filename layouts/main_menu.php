<div class="main-menu">
    <div class="menu-inner">
        <nav>
            <ul class="metismenu" id="menu">
                <li class="<?php if ($CURRENT_PAGE == "Dashboard") { ?>active<?php } ?>">
                    <a href="/" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                </li>
                <li>
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Sim Details</span></a>
                    <ul class="collapse">
                        <li class="<?php if ($CURRENT_PAGE == "Sim Details") { ?>active<?php } ?>"><a
                                    href="sim-details">Search</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Employee</span></a>
                    <ul class="collapse">
                        <li class="<?php if ($CURRENT_PAGE == "Employee") { ?>active<?php } ?>"><a
                                    href="employee">Search</a></li>
                    </ul>
                </li>
                <?php
                if ($_SESSION['user_role_id'] == 1) {
                    ?>
                    <div style="margin:1rem;"></div>
                    <div style="border:.5px dashed #aaa; opacity:.3; margin:0 1rem;"></div>
                    <div style="margin:1rem;"></div>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                    class="fa fa-user"></i><span>User Account</span></a>
                        <ul class="collapse">
                            <li class="<?php if ($CURRENT_PAGE == "Users Control") { ?>active<?php } ?>"><a
                                        href="users-control">Users Control</a></li>
                        </ul>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </nav>
    </div>
</div>