<?php

if (!isset($_SESSION)) {
    session_start();
}

$MM_restrictGoTo = "login?login=required";
if (!((isset($_SESSION['U_Email'])))) {
    $MM_qsChar = "?";
    $MM_referrer = $_SERVER['REQUEST_URI'];
    if (strpos($MM_restrictGoTo, "?")) {
        $MM_qsChar = "&";
    }
    if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) {
        $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
    }
    $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
    header("Location: ". $MM_restrictGoTo);
    exit;
}
