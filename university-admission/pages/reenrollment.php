<?php
session_start();
include '../config.php';

if(!isset($_SESSION['no_pendaftaran'])){
    header("location:../auth/login.php");
    exit;
}

$no_pendaftaran = $_SESSION['no_pendaftaran'];
$mahasiswa_id   = $_SESSION['mahasiswa_id'];

$query = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE no_pendaftaran='$no_pendaftaran'");
$data  = mysqli_fetch_assoc($query);

// Harus lulus ujian dulu
if($data['status_ujian'] != 'Lulus'){
    echo "<script>alert('Anda harus lulus ujian terlebih dahulu!'); window.location='profil.php';</script>";
    exit;
}

// Sudah bayar?
if($data['status_pembayaran'] == 'Lunas'){
    echo "<script>alert('Anda sudah melakukan pembayaran daftar ulang.'); window.location='profil.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ulang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="form-card">
                <h2 class="text-center mb-4">Pembayaran Daftar Ulang</h2>

                <div class="alert alert-info rounded-4 mb-4">
                    💡 Halo <strong><?= htmlspecialchars($data['nama_lengkap']); ?></strong>! 
                    NIM kamu: <strong><?= htmlspecialchars($data['nim']); ?></strong><br>
                    Lakukan pembayaran daftar ulang untuk menyelesaikan proses pendaftaran.
                </div>

                <form method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label>Nama Mahasiswa</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($data['nama_lengkap']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label>NIM</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($data['nim']); ?>" readonly>
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
                    </div>

                    <button type="submit" name="bayar" class="btn-main w-100">
                        Kirim Pembayaran
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
if(isset($_POST['bayar'])){

    $metode = mysqli_real_escape_string($conn, $_POST['metode']);
    $file   = $_FILES['bukti']['name'];
    $tmp    = $_FILES['bukti']['tmp_name'];

    $ext     = pathinfo($file, PATHINFO_EXTENSION);
    $newName = "daftar_ulang_" . time() . "." . $ext;

    move_uploaded_file($tmp, "../uploads/dokumen/" . $newName);

    mysqli_query($conn,"
        INSERT INTO pembayaran(mahasiswa_id, metode_pembayaran, bukti_pembayaran, status)
        VALUES('$mahasiswa_id', '$metode', '$newName', 'Menunggu')
    ");

    // Update status pembayaran jadi Menunggu
    mysqli_query($conn,"
        UPDATE mahasiswa SET status_pembayaran='Menunggu'
        WHERE no_pendaftaran='$no_pendaftaran'
    ");

    echo "<script>
        alert('Pembayaran berhasil dikirim! Tunggu verifikasi admin.');
        window.location='profil.php';
    </script>";
}
?>
