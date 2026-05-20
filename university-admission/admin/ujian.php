<?php
include '../config.php';

if(isset($_POST['simpan'])){
    $id     = $_POST['mahasiswa_id'];
    $status = $_POST['status'];

    mysqli_query($conn,"UPDATE mahasiswa SET status_ujian='$status' WHERE id='$id'");

    if($status == 'Lulus'){
        // Cek kalau belum punya NIM
        $ceknim = mysqli_query($conn,"SELECT nim FROM mahasiswa WHERE id='$id'");
        $row = mysqli_fetch_assoc($ceknim);
        if(empty($row['nim'])){
            $nim = "NIM" . date('Y') . rand(10000,99999);
            mysqli_query($conn,"UPDATE mahasiswa SET nim='$nim' WHERE id='$id'");
        }
    }

    header("location:ujian.php?success=1");
    exit;
}

$data = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE status_berkas='Diterima' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Ujian</title>
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
                <h1 class="fw-bold">Input Nilai Ujian</h1>
                <p class="mb-0 opacity-75">Update status kelulusan ujian mahasiswa</p>
            </div>
            <a href="dashboard.php" class="btn btn-light rounded-4 px-4">
                <i class="bi bi-arrow-left me-2"></i>Dashboard
            </a>
        </div>
    </div>

    <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success rounded-4 mb-4">✅ Status ujian berhasil diupdate!</div>
    <?php endif; ?>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Pendaftaran</th>
                        <th>Status Ujian</th>
                        <th>NIM</th>
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
                        <?php
                        $su = $d['status_ujian'];
                        $b = $su == 'Lulus' ? 'primary' : ($su == 'Tidak Lulus' ? 'danger' : 'secondary');
                        ?>
                        <span class="badge bg-<?= $b; ?> px-3 py-2 rounded-pill"><?= $su; ?></span>
                    </td>
                    <td><?= $d['nim'] ? htmlspecialchars($d['nim']) : '<span class="text-muted">-</span>'; ?></td>
                    <td>
                        <form method="POST" class="d-flex gap-2 align-items-center">
                            <input type="hidden" name="mahasiswa_id" value="<?= $d['id']; ?>">
                            <select name="status" class="form-select form-select-sm rounded-3" style="width:140px;">
                                <option value="Belum" <?= $d['status_ujian']=='Belum'?'selected':''; ?>>Belum</option>
                                <option value="Lulus" <?= $d['status_ujian']=='Lulus'?'selected':''; ?>>Lulus</option>
                                <option value="Tidak Lulus" <?= $d['status_ujian']=='Tidak Lulus'?'selected':''; ?>>Tidak Lulus</option>
                            </select>
                            <button name="simpan" class="btn btn-primary btn-sm rounded-3">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </form>
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
