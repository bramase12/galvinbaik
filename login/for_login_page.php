<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: /galvinbaik/index.php');
    exit;
}

// Tambahkan pengecekan role untuk halaman admin
$current_path = $_SERVER['PHP_SELF'];
if (strpos($current_path, '/adminpage/') !== false) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: /galvinbaik/beranda.php');
        exit;
    }
}
?>