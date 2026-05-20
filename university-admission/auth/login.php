<?php
session_start();
include '../config.php';

if(isset($_POST['login'])){

    $no_pendaftaran = $_POST['no_pendaftaran'];
    $password = md5($_POST['password']);

    // Login bisa untuk semua mahasiswa (tidak harus status Diterima)
    $query = mysqli_query($conn,"
    SELECT * FROM mahasiswa
    WHERE no_pendaftaran='$no_pendaftaran'
    AND password='$password'
    ");

    if(mysqli_num_rows($query) > 0){

        $data = mysqli_fetch_array($query);

        $_SESSION['nama']           = $data['nama_lengkap'];
        $_SESSION['no_pendaftaran'] = $data['no_pendaftaran'];
        $_SESSION['nim']            = $data['nim'];
        $_SESSION['mahasiswa_id']   = $data['id'];

        header("location:../pages/profil.php");
        exit;

    } else {
        echo "<script>alert('Login gagal! Periksa No Pendaftaran dan Password.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
    background: linear-gradient(135deg,#1e3a8a,#2563eb);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}
.login-card{
    width:100%;
    max-width:420px;
    background:white;
    padding:40px;
    border-radius:30px;
    box-shadow:0 20px 40px rgba(0,0,0,0.15);
}
</style>
</head>
<body>
<div class="login-card">
    <h2 class="fw-bold text-center mb-4">Login Mahasiswa</h2>
    <form method="POST">
        <div class="mb-3">
            <label>No Pendaftaran</label>
            <input type="text" name="no_pendaftaran" class="form-control" placeholder="Contoh: PMB2026001" required>
        </div>
        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100 py-3 rounded-4">Login</button>
        <p class="text-center mt-3 text-secondary">Belum punya akun? <a href="register.php">Register</a></p>
    </form>
</div>
</body>
</html>
