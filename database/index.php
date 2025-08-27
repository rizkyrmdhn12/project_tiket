<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "aplikasi ticketing pesawat dan kereta api"; // Gunakan nama tanpa spasi

// Koneksi ke database
$koneksi = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Inisialisasi variabel
$nama       = "";
$nik        = "";
$email      = "";
$pass_input = "";
$berhasil   = "";
$gagal      = "";

// Proses saat form disubmit
if (isset($_POST['submit'])) {
    $nama       = trim($_POST['nama']);
    $nik        = trim($_POST['nik']);
    $email      = trim($_POST['email']);
    $pass_input = $_POST['password'];

    if (!empty($nama) && !empty($nik) && !empty($email) && !empty($pass_input)) {

        $hashPass = password_hash($pass_input, PASSWORD_DEFAULT);

        $stmt = $koneksi->prepare("INSERT INTO login (nama, nik, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $nik, $email, $hashPass);

        if ($stmt->execute()) {
            $berhasil = "Data berhasil dimasukkan";
        } else {
            $gagal = "Data gagal dimasukkan: " . $stmt->error;
        }

        $stmt->close();
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
