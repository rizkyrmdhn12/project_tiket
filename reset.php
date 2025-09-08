<?php
session_start();
include_once 'database/koneksi.php';

$reset_message = "";

if (isset($_POST['reset_password'])) {
    $username = $_POST['username'];

    // Di sini Anda akan menambahkan logika untuk mengirim email reset kata sandi
    // Untuk tujuan demonstrasi, kita akan menampilkan pesan sederhana.
    $reset_message = "Instruksi reset kata sandi telah dikirim ke email yang terkait dengan akun " . htmlspecialchars($username) . ".";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi</title>
    <link rel="stylesheet" href="models/style.css">
</head>
<body>
    <div class="container">
        <div class="form-box active">
            <h2>Reset Kata Sandi</h2>
            <br>
            <i style="color: green;"><?= $reset_message ?></i>
            <br>
            <form action="reset.php" method="POST">
                <div class="input-box">
                    <input type="text" name="username" placeholder=" " required>
                    <span class="label">Masukkan Username</span>
                </div>
                <button type="submit" name="reset_password">Reset Kata Sandi</button>
            </form>
            <div class="register-text">
                Kembali ke <a href="login.php">Login</a>
            </div>
        </div>
    </div>
</body>
</html>