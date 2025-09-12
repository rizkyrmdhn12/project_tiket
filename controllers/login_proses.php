<?php
session_start();
include_once 'database/koneksi.php';

$login_message = "";

if (isset($_POST['masuk'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query login
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Query gagal diproses: " . $conn->error); // debug jika query gagal
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];

        //proses login
        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            
            header("location: dashboard.php");
            exit;
        } else {
            $login_message = "Password salah. Coba lagi.";
        }
    } else {
        $login_message = "Akun tidak ditemukan.";
    }
    
    $stmt->close();
}
$conn->close();
?>