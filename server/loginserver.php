<?php
session_start();
$host = 'localhost';
$db = 'fufastore';
$user = 'root'; 
$pass = 'gregoganteng'; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}