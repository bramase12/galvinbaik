<?php
session_start();
$host = 'b0umeuwgewtekd1ruqna-mysql.services.clever-cloud.com';
$db = 'b0umeuwgewtekd1ruqna';
$user = 'ucdsh8ex7hull0na'; 
$pass = 'mteCuHDHDtZ9Utyz4UaZ'; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}