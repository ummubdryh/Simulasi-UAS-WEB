<?php
session_start();
include '../config.php';

if(!isset($_SESSION['no_pendaftaran'])){
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='../auth/login.php';</script>";
    exit;
}

$no_pendaftaran = $_SESSION['no_pendaftaran'];

// Ambil data mahasiswa
$query = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE no_pendaftaran='$no_pendaftaran'");
$data  = mysqli_fetch_assoc($query);

// Cek status berkas diterima dulu
if($data['status_berkas'] != 'Diterima'){
    echo "<script>alert('Berkas Anda belum diverifikasi admin. Silakan tunggu.'); window.location='profil.php';</script>";
    exit;
}

// Cek sudah pernah ujian
if($data['status_ujian'] != 'Belum'){
    echo "<script>alert('Anda sudah mengikuti ujian. Status: " . $data['status_ujian'] . "'); window.location='profil.php';</script>";
    exit;
}

// Kunci jawaban
$kunci = [
    'soal1' => '20',
    'soal2' => 'Book',
];

$hasil = null;

if(isset($_POST['submit_ujian'])){

    $jawaban1 = $_POST['soal1'] ?? '';
    $jawaban2 = $_POST['soal2'] ?? '';

    $benar = 0;
    if($jawaban1 == $kunci['soal1']) $benar++;
    if($jawaban2 == $kunci['soal2']) $benar++;

    $nilai  = ($benar / 2) * 100;
    $status = $nilai >= 50 ? 'Lulus' : 'Tidak Lulus';

    // Simpan ke tabel ujian
    $mhs_id = $data['id'];
    mysqli_query($conn,"
        INSERT INTO ujian(mahasiswa_id, nilai, status)
        VALUES('$mhs_id', '$nilai', '$status')
    ");

    // Update status ujian & kasih NIM kalau lulus
    if($status == 'Lulus'){
        $nim = "NIM" . date('Y') . rand(10000,99999);
        mysqli_query($conn,"
            UPDATE mahasiswa
            SET status_ujian='Lulus', nim='$nim'
            WHERE no_pendaftaran='$no_pendaftaran'
        ");
        $_SESSION['nim'] = $nim;
    } else {
        mysqli_query($conn,"
            UPDATE mahasiswa
            SET status_ujian='Tidak Lulus'
            WHERE no_pendaftaran='$no_pendaftaran'
        ");
    }

    $hasil = ['status' => $status, 'nilai' => $nilai];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-card">

                <h2 class="mb-4 text-center">Ujian Online</h2>

                <?php if($hasil === null): ?>

                <form method="POST">

                    <div class="mb-4">
                        <label class="fw-semibold mb-2">1. 10 + 10 = ?</label>
                        <select class="form-select" name="soal1" required>
                            <option value="">-- Pilih Jawaban --</option>
                            <option>10</option>
                            <option>20</option>
                            <option>30</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="fw-semibold mb-2">2. Bahasa Inggris dari Buku adalah?</label>
                        <select class="form-select" name="soal2" required>
                            <option value="">-- Pilih Jawaban --</option>
                            <option>Table</option>
                            <option>Book</option>
                            <option>Chair</option>
                        </select>
                    </div>

                    <button type="submit" name="submit_ujian" class="btn-main w-100">
                        Selesai Ujian
                    </button>

                </form>

                <?php else: ?>

                <div class="text-center py-4">
                    <?php if($hasil['status'] == 'Lulus'): ?>
                    <div class="alert alert-success rounded-4">
                        <h4 class="mb-2">🎉 Selamat! Anda LULUS</h4>
                        <p class="mb-0">Nilai: <?= $hasil['nilai']; ?>/100</p>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-danger rounded-4">
                        <h4 class="mb-2">😔 Maaf, Anda Tidak Lulus</h4>
                        <p class="mb-0">Nilai: <?= $hasil['nilai']; ?>/100</p>
                    </div>
                    <?php endif; ?>
                    <a href="profil.php" class="btn-main mt-3">Kembali ke Profil</a>
                </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
