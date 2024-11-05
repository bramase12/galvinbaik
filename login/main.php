<?php
require '../server/loginserver.php'
// Proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek kredensial pengguna
    $stmt = $conn->prepare("SELECT * FROM fufastore.users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            // Redirect berdasarkan role
            if ($user['role'] === 'admin') {
                header('Location: /galvinbaik/adminpage/beranda.php');
            } else {
                header('Location: /galvinbaik/beranda.php');
            }
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>