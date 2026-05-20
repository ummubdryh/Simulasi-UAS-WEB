<?php
include '../config.php';

// Verifikasi pembayaran daftar ulang
if(isset($_POST['aksi'])){
    $id   = $_POST['pembayaran_id'];
    $mhsid = $_POST['mahasiswa_id'];
    $aksi = $_POST['aksi'];

    if($aksi == 'lunas'){
        mysqli_query($conn,"UPDATE pembayaran SET status='Lunas' WHERE id='$id'");
        mysqli_query($conn,"UPDATE mahasiswa SET status_pembayaran='Lunas' WHERE id='$mhsid'");
    } elseif($aksi == 'tolak'){
        mysqli_query($conn,"UPDATE pembayaran SET status='Ditolak' WHERE id='$id'");
        mysqli_query($conn,"UPDATE mahasiswa SET status_pembayaran='Belum Bayar' WHERE id='$mhsid'");
    }

    header("location:pembayaran.php");
    exit;
}

$data = mysqli_query($conn,"
    SELECT p.*, m.nama_lengkap, m.nim, m.no_pendaftaran
    FROM pembayaran p
    LEFT JOIN mahasiswa m ON m.id = p.mahasiswa_id
    ORDER BY p.id DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body{ background:#f1f5f9; }
        .page-header{
            background: linear-gradient(135deg,#2563eb,#1e3a8a);
            border-radius:30px; padding:40px; color:white; margin-bottom:40px;
        }
        .table-card{ background:white; border-radius:30px; padding:35px; box-shadow:0 15px 35px rgba(0,0,0,0.05); }
        .table thead th{ background:#2563eb !important; color:white; border:none; padding:16px; }
        .table td{ padding:16px; vertical-align:middle; }
    </style>
</head>
<body>
<div class="container py-5">

    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="fw-bold">Data Pembayaran</h1>
                <p class="mb-0 opacity-75">Verifikasi pembayaran mahasiswa</p>
            </div>
            <a href="dashboard.php" class="btn btn-light rounded-4 px-4">
                <i class="bi bi-arrow-left me-2"></i>Dashboard
            </a>
        </div>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Metode</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; while($d = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="fw-semibold"><?= htmlspecialchars($d['nama_lengkap'] ?? '-'); ?></td>
                    <td><?= htmlspecialchars($d['metode_pembayaran']); ?></td>
                    <td>
                        <?php if($d['bukti_pembayaran']): ?>
                        <a href="../uploads/dokumen/<?= $d['bukti_pembayaran']; ?>" target="_blank" class="btn btn-outline-primary btn-sm rounded-3">
                            <i class="bi bi-eye"></i> Lihat
                        </a>
                        <?php else: ?>
                        <span class="text-muted small">-</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                        $st = $d['status'];
                        $b = $st == 'Lunas' ? 'success' : ($st == 'Ditolak' ? 'danger' : 'warning text-dark');
                        ?>
                        <span class="badge bg-<?= $b; ?> px-3 py-2 rounded-pill"><?= $st; ?></span>
                    </td>
                    <td>
                        <?php if($d['status'] == 'Menunggu'): ?>
                        <form method="POST" class="d-flex gap-2">
                            <input type="hidden" name="pembayaran_id" value="<?= $d['id']; ?>">
                            <input type="hidden" name="mahasiswa_id" value="<?= $d['mahasiswa_id']; ?>">
                            <button name="aksi" value="lunas" class="btn btn-success btn-sm rounded-3">
                                <i class="bi bi-check-circle"></i> Lunas
                            </button>
                            <button name="aksi" value="tolak" class="btn btn-danger btn-sm rounded-3"
                                onclick="return confirm('Tolak pembayaran ini?')">
                                <i class="bi bi-x-circle"></i> Tolak
                            </button>
                        </form>
                        <?php else: ?>
                        <span class="text-muted small">Sudah diproses</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
