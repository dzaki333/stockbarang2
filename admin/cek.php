<?php

if (!isset($_SESSION['admin_log'])) {
    header("Location: loginadmin.php");
    exit;
}

$idadmin = $_SESSION['admin_id'];
