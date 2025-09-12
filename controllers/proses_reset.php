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