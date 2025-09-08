<?php 
session_start();
include_once 'database/koneksi.php';

$register_message = "";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $register_message = "Username dan password tidak boleh kosong!";
    } else {
        // Cek apakah username sudah ada
        $sql_check = "SELECT id FROM users WHERE username = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $register_message = "Username sudah terdaftar, silakan gunakan username lain.";
        } else {
            // Hash kata sandi untuk keamanan
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Masukkan data pengguna baru ke database
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $register_message = "Daftar berhasil! Silakan <a href='login.php'>Login</a>.";
                // Kosongkan input setelah berhasil
                $username = $password = "";
            } else {
                $register_message = "Daftar gagal, silakan coba lagi.";
            }
            $stmt->close();
        }
        $stmt_check->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Registrasi Pengguna</title>
  <link rel="stylesheet" href="models/style.css">
</head>
<body>
  

<div class="container">
    <div class="form-box active">
        <h2>DAFTAR</h2>
        <br>
        <i style="color: red;"><?= $register_message ?></i>
        <form action="register.php" method="POST">
            <div class="input-box">
                <input type="text" name="username" placeholder=" " required>
                <span class="label">Username</span>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder=" " required>
                <span class="label">Password</span>
            </div>
            <button type="submit" name="register">Daftar Sekarang</button>
        </form>
        <div class="register-text">
            Sudah punya akun? <a href="login.php">Login</a>
        </div>
    </div>
</div>

  
</body>
</html>