<?php
require __DIR__ . '/../server/loginserver.php';
// Proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek kredensial pengguna
    // Prepared statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM fufastore.users WHERE username = ?");
    $stmt->bind_param("s", $username); // Bind the username as a string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session variables for login
            session_start(); // Ensure session is started
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
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
