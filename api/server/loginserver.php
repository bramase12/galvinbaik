<?php
session_start();
$host = 'm8r6rh.h.filess.io';
$db = 'fufastore_cottonpen';
$user = 'fufastore_cottonpen'; 
$pass = 'e4b455cea48e9a519548228aa20d403642e94e4c'; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}