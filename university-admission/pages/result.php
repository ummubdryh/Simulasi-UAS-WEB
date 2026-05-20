<?php
session_start();
include '../config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="form-card">

                <h2 class="text-center mb-4">Cek Pengumuman</h2>

                <form method="POST">
                    <div class="mb-3">
                        <label>Masukkan No Pendaftaran</label>
                        <input type="text" name="no_pendaftaran" class="form-control" 
                               placeholder="Contoh: PMB2026001"
                               value="<?= isset($_SESSION['no_pendaftaran']) ? htmlspecialchars($_SESSION['no_pendaftaran']) : ''; ?>"
                               required>
                    </div>
                    <button type="submit" name="cek" class="btn-main w-100">Cek Hasil</button>
                </form>

                <?php
                if(isset($_POST['cek'])){
                    $no_pendaftaran = mysqli_real_escape_string($conn, $_POST['no_pendaftaran']);
                    $query = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE no_pendaftaran='$no_pendaftaran'");
                    $data  = mysqli_fetch_assoc($query);

                    if($data){
                        echo "<div class='mt-4 p-4 rounded-4' style='background:#f8fafc; border:1px solid #e2e8f0;'>";
                        echo "<h5 class='fw-bold mb-3'>" . htmlspecialchars($data['nama_lengkap']) . "</h5>";

                        if($data['status_ujian'] == 'Lulus'){
                            echo "<div class='alert alert-success rounded-4'>🎉 Selamat! Anda dinyatakan <b>LULUS</b><br>NIM: <strong>" . htmlspecialchars($data['nim']) . "</strong></div>";
                        } elseif($data['status_ujian'] == 'Tidak Lulus'){
                            echo "<div class='alert alert-danger rounded-4'>😔 Maaf, Anda dinyatakan <b>TIDAK LULUS</b></div>";
                        } else {
                            echo "<div class='alert alert-warning rounded-4'>⏳ Hasil ujian <b>belum tersedia</b>. Ikuti ujian terlebih dahulu.</div>";
                        }
                        echo "</div>";
                    } else {
                        echo "<div class='alert alert-warning mt-4 rounded-4'>No Pendaftaran tidak ditemukan.</div>";
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
