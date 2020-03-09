<?php
switch ($_SERVER["SCRIPT_NAME"]) {
    case "/403.php":
        $CURRENT_PAGE = "403 Forbidden";
        $PAGE_TITLE = "403 Forbidden";
        break;
    case "/404.php":
        $CURRENT_PAGE = "404 Forbidden";
        $PAGE_TITLE = "404 Forbidden";
        break;
    case "/503.php":
        $CURRENT_PAGE = "503 Forbidden";
        $PAGE_TITLE = "503 Forbidden";
        break;
    case "./nic-photo.php":
        $CURRENT_PAGE = "Sim Details";
        $PAGE_TITLE = "Sim Details";
        break;
    case "/login.php":
        $CURRENT_PAGE = "Login";
        $PAGE_TITLE = "Login";
        break;
    case "/pdf_sim_details.php":
        $CURRENT_PAGE = "Sim Details";
        $PAGE_TITLE = "Sim Details";
        break;
    case "/users-control.php":
        $CURRENT_PAGE = "Users Control";
        $PAGE_TITLE = "Users Control";
        break;
    case "/change-password.php":
        $CURRENT_PAGE = "Change Password";
        $PAGE_TITLE = "Change Password";
        break;
    case "/my-account.php":
        $CURRENT_PAGE = "My Account";
        $PAGE_TITLE = "My Account";
        break;
    case "/employee.php":
        $CURRENT_PAGE = "Employee";
        $PAGE_TITLE = "Employee";
        break;
    default:
        $CURRENT_PAGE = "Dashboard";
        $PAGE_TITLE = "Dashboard";
}
