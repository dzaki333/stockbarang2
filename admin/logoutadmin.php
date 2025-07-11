<?php
session_start();

// Hapus semua session admin
session_unset();
session_destroy();

// Arahkan kembali ke halaman login admin
header('Location: loginadmin.php');
exit;
