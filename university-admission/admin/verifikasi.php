<?php
include '../config.php';

// Verifikasi/Tolak berkas mahasiswa
if(isset($_POST['aksi'])){
    $id    = $_POST['id'];
    $aksi  = $_POST['aksi'];

    if($aksi == 'terima'){
        mysqli_query($conn,"UPDATE mahasiswa SET status_berkas='Diterima' WHERE id='$id'");
        // Update pembayaran jadi Lunas
        mysqli_query($conn,"UPDATE pembayaran SET status='Lunas' WHERE mahasiswa_id='$id'");
        mysqli_query($conn,"UPDATE mahasiswa SET status_pembayaran='Menunggu' WHERE id='$id'");
    } elseif($aksi == 'tolak'){
        mysqli_query($conn,"UPDATE mahasiswa SET status_berkas='Ditolak' WHERE id='$id'");
        mysqli_query($conn,"UPDATE pembayaran SET status='Ditolak' WHERE mahasiswa_id='$id'");
    }

    header("location:verifikasi.php");
    exit;
}

$data = mysqli_query($conn,"SELECT m.*, p.bukti_pembayaran, p.metode_pembayaran, p.status as status_bayar
    FROM mahasiswa m
    LEFT JOIN pembayaran p ON p.mahasiswa_id = m.id
    ORDER BY m.id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Berkas</title>
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
                <h1 class="fw-bold">Verifikasi Berkas</h1>
                <p class="mb-0 opacity-75">Review dan verifikasi berkas mahasiswa</p>
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
                        <th>No Pendaftaran</th>
                        <th>Bukti Bayar</th>
                        <th>Status Berkas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; while($d = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="fw-semibold"><?= htmlspecialchars($d['nama_lengkap']); ?></td>
                    <td><small><?= htmlspecialchars($d['no_pendaftaran'] ?? '-'); ?></small></td>
                    <td>
                        <?php if($d['bukti_pembayaran']): ?>
                        <a href="../uploads/dokumen/<?= $d['bukti_pembayaran']; ?>" target="_blank" class="btn btn-outline-primary btn-sm rounded-3">
                            <i class="bi bi-eye"></i> Lihat
                        </a>
                        <?php else: ?>
                        <span class="text-muted small">Belum ada</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                        $sb = $d['status_berkas'];
                        $badge = $sb == 'Diterima' ? 'success' : ($sb == 'Ditolak' ? 'danger' : 'warning text-dark');
                        ?>
                        <span class="badge bg-<?= $badge; ?> px-3 py-2 rounded-pill"><?= $sb; ?></span>
                    </td>
                    <td>
                        <?php if($d['status_berkas'] == 'Pending'): ?>
                        <form method="POST" class="d-flex gap-2">
                            <input type="hidden" name="id" value="<?= $d['id']; ?>">
                            <button name="aksi" value="terima" class="btn btn-success btn-sm rounded-3">
                                <i class="bi bi-check-circle"></i> Terima
                            </button>
                            <button name="aksi" value="tolak" class="btn btn-danger btn-sm rounded-3"
                                onclick="return confirm('Yakin tolak berkas ini?')">
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
