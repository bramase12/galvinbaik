<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ./galvinbaik/index.php'); 
    exit;
}
?>
