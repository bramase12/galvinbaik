<?php
session_start();
$host = 'localhost';
$db = 'fufastore';
$user = 'root'; 
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db); // Tambahkan $db di sini

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek kredensial pengguna
    $stmt = $conn->prepare("SELECT * FROM fufastore.users WHERE username = ?"); // Tambahkan nama database
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: beranda.php');
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>