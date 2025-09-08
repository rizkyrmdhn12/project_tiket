<?php
session_start();
include_once 'database/koneksi.php'; // pastikan variabel koneksi namanya sesuai

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

        if (password_verify($password, $hashed_password)) {
            // Login berhasil
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login Page</title>
    <link rel="stylesheet" href="models/style.css">
</head>
<body>
    <div class="container">
        <div class="form-box active">
            <h2>Welcome Back</h2>
            <br>
            <i style="color: red;"><?= $login_message ?></i>
            <br>
            <form action="login.php" method="POST">
                <div class="input-box">
                    <input type="text" name="username" placeholder=" " required>
                    <span class="label">Username</span>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder=" " required>
                    <span class="label">Password</span>
                </div>
                <button type="submit" name="masuk">Login</button>
            </form>
            <div class="register-text">
                <a href="reset.php">Lupa kata sandi?</a>
            </div>
            <div class="register-text">
                Belum punya akun? <a href="register.php">Buat Akun</a>
            </div>
        </div>
    </div>
</body>
</html>