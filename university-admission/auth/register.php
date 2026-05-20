<?php
include '../config.php';

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $password = md5($_POST['password']);

    // Cek email sudah terdaftar
    $cek = mysqli_query($conn, "SELECT id FROM mahasiswa WHERE email='$email'");
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Email sudah terdaftar!'); window.location='register.php';</script>";
        exit;
    }

    $cek_id = mysqli_query($conn,"SELECT MAX(id) as last_id FROM mahasiswa");
    $data_id = mysqli_fetch_assoc($cek_id);
    $urutan = (int)$data_id['last_id'] + 1;
    $no_pendaftaran = "PMB" . date('Y') . str_pad($urutan,3,'0',STR_PAD_LEFT);

    $insert = mysqli_query($conn,
    "INSERT INTO mahasiswa(
    no_pendaftaran,
    nama_lengkap,
    email,
    no_hp,
    asal_sekolah,
    password,
    status_berkas,
    status_ujian,
    status_pembayaran
    )
    VALUES(
    '$no_pendaftaran',
    '$nama',
    '$email',
    '$no_hp',
    '$asal_sekolah',
    '$password',
    'Pending',
    'Belum',
    'Belum Bayar'
    )"
    );

    if($insert){
        echo "
        <script>
        alert('Register berhasil!\n\nNomor Pendaftaran kamu: $no_pendaftaran\n\nSimpan nomor ini untuk login!');
        window.location='login.php';
        </script>
        ";
    }else{
        echo "<script>alert('Register gagal: " . mysqli_error($conn) . "'); window.location='register.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
    background: linear-gradient(135deg,#2563eb,#1e3a8a);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}
.register-card{
    width:100%;
    max-width:500px;
    background:white;
    padding:40px;
    border-radius:30px;
    box-shadow:0 20px 40px rgba(0,0,0,0.15);
}
</style>
</head>
<body>
<div class="register-card">
    <h2 class="fw-bold text-center mb-4">Register PMB</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Asal Sekolah</label>
            <input type="text" name="asal_sekolah" class="form-control" required>
        </div>
        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="register" class="btn btn-primary w-100 py-3 rounded-4">
            Register
        </button>
        <p class="text-center mt-3 text-secondary">Sudah punya akun? <a href="login.php">Login</a></p>
    </form>
</div>
</body>
</html>
