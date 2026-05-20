<?php
session_start();
include '../config.php';

if(!isset($_SESSION['no_pendaftaran'])){
    header('location:../auth/login.php');
    exit;
}

$no_pendaftaran = $_SESSION['no_pendaftaran'];

$query = mysqli_query($conn,
    "SELECT * FROM mahasiswa WHERE no_pendaftaran='$no_pendaftaran' LIMIT 1"
);
$data = mysqli_fetch_assoc($query);

if(!$data){
    session_destroy();
    header('location:../auth/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/navbar.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="form-card mb-4">
                <h2 class="fw-bold mb-4 text-center">Profil Mahasiswa</h2>

                <table class="table">
                    <tr>
                        <th width="200">No Pendaftaran</th>
                        <td><?= htmlspecialchars($data['no_pendaftaran'] ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td><?= htmlspecialchars($data['nama_lengkap']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= htmlspecialchars($data['email']); ?></td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td><?= htmlspecialchars($data['no_hp']); ?></td>
                    </tr>
                    <tr>
                        <th>Asal Sekolah</th>
                        <td><?= htmlspecialchars($data['asal_sekolah']); ?></td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td><?= $data['nim'] ? htmlspecialchars($data['nim']) : '<span class="text-muted">Belum ada (menunggu kelulusan)</span>'; ?></td>
                    </tr>
                </table>
            </div>

            <!-- STATUS CARD -->
            <div class="form-card mb-4">
                <h4 class="fw-bold mb-4">Status Pendaftaran</h4>
                <div class="row g-3">

                    <div class="col-md-4">
                        <div class="p-3 rounded-4 text-center" style="background:#f8fafc; border:1px solid #e2e8f0;">
                            <div class="small text-secondary mb-2">Status Berkas</div>
                            <?php
                            $sb = $data['status_berkas'];
                            $badge = $sb == 'Diterima' ? 'success' : ($sb == 'Ditolak' ? 'danger' : 'warning');
                            ?>
                            <span class="badge bg-<?= $badge; ?> px-3 py-2 rounded-pill"><?= $sb; ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 rounded-4 text-center" style="background:#f8fafc; border:1px solid #e2e8f0;">
                            <div class="small text-secondary mb-2">Status Ujian</div>
                            <?php
                            $su = $data['status_ujian'];
                            $badge2 = $su == 'Lulus' ? 'primary' : ($su == 'Tidak Lulus' ? 'danger' : 'secondary');
                            ?>
                            <span class="badge bg-<?= $badge2; ?> px-3 py-2 rounded-pill"><?= $su; ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 rounded-4 text-center" style="background:#f8fafc; border:1px solid #e2e8f0;">
                            <div class="small text-secondary mb-2">Status Pembayaran</div>
                            <?php
                            $sp = $data['status_pembayaran'];
                            $badge3 = $sp == 'Lunas' ? 'success' : ($sp == 'Menunggu' ? 'warning' : 'secondary');
                            ?>
                            <span class="badge bg-<?= $badge3; ?> px-3 py-2 rounded-pill"><?= $sp; ?></span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ALUR / LANGKAH SELANJUTNYA -->
            <div class="form-card">
                <h4 class="fw-bold mb-4">Langkah Selanjutnya</h4>
                <div class="d-grid gap-3">

                    <?php if($data['status_berkas'] == 'Pending'): ?>
                    <div class="alert alert-warning rounded-4">
                        ⏳ <strong>Berkas kamu sedang diverifikasi admin.</strong> Tunggu konfirmasi melalui halaman ini.
                    </div>
                    <?php endif; ?>

                    <?php if($data['status_berkas'] == 'Diterima' && $data['status_ujian'] == 'Belum'): ?>
                    <a href="exam.php" class="btn-main text-center">
                        📝 Ikuti Ujian Masuk
                    </a>
                    <?php endif; ?>

                    <?php if($data['status_ujian'] == 'Lulus'): ?>
                    <a href="result.php" class="btn-main text-center">
                        🏆 Lihat Pengumuman Kelulusan
                    </a>
                    <?php endif; ?>

                    <?php if($data['status_ujian'] == 'Lulus' && $data['status_pembayaran'] != 'Lunas'): ?>
                    <a href="reenrollment.php" class="btn-main text-center">
                        💳 Daftar Ulang & Bayar
                    </a>
                    <?php endif; ?>

                    <?php if($data['status_pembayaran'] == 'Lunas'): ?>
                    <a href="ospek.php" class="btn-main text-center">
                        🎓 Info OSPEK
                    </a>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
