<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "aplikasi ticketing pesawat dan kereta api";

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

$nama = "";
$nik = "";
$email = "";
$berhasil = "";
$gagal = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nama = trim($_POST['nama']);
    $nik = trim($_POST['nik']);
    $email = trim($_POST['email']);
    $pass_input = $_POST['password'];

    if (!empty($nama) && !empty($nik) && !empty($email) && !empty($pass_input)) {

        $hashPass = password_hash($pass_input, PASSWORD_DEFAULT);

        $stmt = $koneksi->prepare("INSERT INTO login (nama, nik, email, password) VALUES (?, ?, ?, ?)");
        
        if ($stmt) {
            $stmt->bind_param("ssss", $nama, $nik, $email, $hashPass);

            if ($stmt->execute()) {
                $berhasil = "Pendaftaran berhasil!";
                $nama = $nik = $email = "";
            } else {
                $gagal = "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $gagal = "Terjadi kesalahan pada prepared statement: " . $koneksi->error;
        }
    } else {
        $gagal = "Semua field wajib diisi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Registrasi</title>
    <link rel="stylesheet" href="../models/style.css" />
</head>
<body>

<form action="" method="post">
    <div class="input-box">
        <input required type="text" class="input" name="nama" placeholder=" " value="<?= htmlspecialchars($nama) ?>" />
        <label class="label">Full Name</label>
    </div>
    <div class="input-box">
        <input required type="text" class="input" name="nik" placeholder=" " value="<?= htmlspecialchars($nik) ?>" />
        <label class="label">NIK</label>
    </div>
    <div class="input-box">
        <input required type="email" class="input" name="email" placeholder=" " value="<?= htmlspecialchars($email) ?>" />
        <label class="label">Email</label>
    </div>
    <div class="input-box">
        <input required type="password" class="input" name="password" placeholder=" " />
        <label class="label">Password</label>
    </div>
    <button type="submit" name="submit">Register</button>
</form>

<?php if (!empty($berhasil)) : ?>
    <p style="color:green;"><?= htmlspecialchars($berhasil) ?></p>
<?php endif; ?>

<?php if (!empty($gagal)) : ?>
    <p style="color:red;"><?= htmlspecialchars($gagal) ?></p>
<?php endif; ?>

</body>
</html>