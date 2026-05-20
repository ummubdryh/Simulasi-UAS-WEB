<?php
session_start();
include '../config.php';

// Admission bisa diakses setelah register & login
if(!isset($_SESSION['no_pendaftaran'])){
    echo "
    <script>
        alert('Anda harus login terlebih dahulu!');
        window.location='../auth/login.php';
    </script>
    ";
    exit;
}

// Cek apakah sudah pernah upload berkas (cek dari pembayaran)
$cek_bayar = mysqli_query($conn,"SELECT id FROM pembayaran WHERE mahasiswa_id='".$_SESSION['mahasiswa_id']."'");
if(mysqli_num_rows($cek_bayar) > 0){
    echo "<script>alert('Anda sudah mengirim berkas pendaftaran. Silakan tunggu verifikasi admin.'); window.location='profil.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pendaftaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="form-card">
        <h2 class="text-center mb-4">Form Pendaftaran Berkas</h2>
        <p class="text-secondary text-center mb-4">Upload bukti pembayaran pendaftaran untuk diverifikasi admin.</p>

        <form method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label>Biaya Pendaftaran</label>
            <input type="text" class="form-control" value="Rp 200.000" readonly>
          </div>

          <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select name="metode" class="form-select" required>
              <option value="">-- Pilih --</option>
              <option>Transfer Bank</option>
              <option>E-Wallet</option>
              <option>Tunai</option>
            </select>
          </div>

          <div class="mb-4">
            <label>Upload Bukti Pembayaran</label>
            <input type="file" name="bukti" class="form-control" accept="image/*,.pdf" required>
            <small class="text-muted">Format: JPG, PNG, PDF. Maks 2MB</small>
          </div>

          <button type="submit" name="submit" class="btn-main w-100">
            Kirim Berkas
          </button>

        </form>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

if(isset($_POST['submit'])){

    $mahasiswa_id = $_SESSION['mahasiswa_id'];
    $metode       = mysqli_real_escape_string($conn, $_POST['metode']);

    // Upload bukti
    $ext      = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
    $newName  = "bukti_daftar_" . time() . "." . $ext;
    $uploadPath = "../uploads/dokumen/" . $newName;

    if(!move_uploaded_file($_FILES['bukti']['tmp_name'], $uploadPath)){
        echo "<script>alert('Upload bukti gagal! Pastikan folder uploads/dokumen ada.'); window.location='admission.php';</script>";
        exit;
    }

    // Simpan pembayaran
    $insert = mysqli_query($conn,"
        INSERT INTO pembayaran(mahasiswa_id, metode_pembayaran, bukti_pembayaran, status)
        VALUES('$mahasiswa_id', '$metode', '$newName', 'Menunggu')
    ");

    if($insert){
        echo "<script>
            alert('Berkas berhasil dikirim! Silakan tunggu verifikasi admin.');
            window.location='profil.php';
        </script>";
    } else {
        echo "<script>alert('Gagal: " . mysqli_error($conn) . "'); window.location='admission.php';</script>";
    }
}
?>
