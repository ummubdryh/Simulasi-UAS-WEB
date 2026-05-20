<?php
session_start();
include '../config.php';

// CEK LOGIN
if(!isset($_SESSION['no_pendaftaran'])){
    header("location:../auth/login.php");
    exit;
}

$no_pendaftaran = $_SESSION['no_pendaftaran'];

$query = mysqli_query($conn,"
SELECT * FROM mahasiswa
WHERE no_pendaftaran='$no_pendaftaran'
");

$data = mysqli_fetch_assoc($query);

// JIKA DATA TIDAK ADA
if(!$data){
    die("Data mahasiswa tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OSPEK Mahasiswa Baru</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="container mt-4">
    <a href="../index.php" class="btn-back">← Kembali</a>
</div>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">OSPEK Mahasiswa Baru 2026</h1>
        <p class="text-secondary">Selamat datang di kegiatan pengenalan kampus.</p>
    </div>

    <div class="alert alert-primary mb-5">
        📢 Wajib hadir tepat waktu & sesuai dresscode
    </div>

    <div class="row g-4">

        <!-- DATA PESERTA -->
        <div class="col-lg-6">
            <div class="form-card h-100">
                <h3 class="mb-4 fw-bold">Data Peserta</h3>

                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td><?= $data['nama_lengkap'] ?? '-'; ?></td>
                    </tr>

                    <tr>
                        <th>NIM</th>
                        <td><?= $data['nim'] ?? 'Belum Lulus'; ?></td>
                    </tr>

                    <tr>
                        <th>Kelompok</th>
                        <td>Kelompok Garuda</td>
                    </tr>

                    <tr>
                        <th>Mentor</th>
                        <td>Kak Rizky</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- DRESSCODE -->
        <div class="col-lg-6">
            <div class="form-card h-100">
                <h3 class="mb-4 fw-bold">Dresscode</h3>
                <ul class="list-group">
                    <li class="list-group-item">👕 Kemeja Putih</li>
                    <li class="list-group-item">👖 Celana Hitam</li>
                    <li class="list-group-item">👟 Sepatu Hitam</li>
                    <li class="list-group-item">🪪 ID Card Peserta</li>
                </ul>
            </div>
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>