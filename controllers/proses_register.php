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
            // Hash kata sandi
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //proses masukan data ke database
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $register_message = "Daftar berhasil! Silakan <a href='login.php' class='text-indigo-500 hover:underline'>Login</a>.";
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