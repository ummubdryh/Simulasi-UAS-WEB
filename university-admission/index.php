<?php
session_start();
include 'includes/navbar.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Sistem Pendaftaran Mahasiswa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet"
    href="assets/css/style.css">

</head>
<body>


<!-- HERO -->
<section class="hero">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-9">

                <div class="hero-content text-center">

                    <span class="badge bg-light text-primary px-4 py-2 mb-4 rounded-pill">

                        Pendaftaran Mahasiswa Baru 2026

                    </span>

                    <h1>

                        Build Your Future <br>
                        With Our University

                    </h1>

                    <p>

                        Sistem pendaftaran mahasiswa baru modern,
                        profesional, cepat, dan terintegrasi
                        untuk mempermudah proses penerimaan mahasiswa.

                    </p>

                    <div class="mt-5">

                        <a href="#alur"
                        class="btn-main me-3">

                            Mulai Sekarang

                        </a>

                        <a href="#tentang"
                        class="btn btn-outline-light px-4 py-3 rounded-4">

                            Pelajari Lebih

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- PROCESS -->
<section id="alur"
class="process-section">

    <div class="container">

        <div class="section-title">

            <h2>
                Alur Pendaftaran
            </h2>

            <p>
                Ikuti tahapan berikut untuk menjadi mahasiswa baru
            </p>

        </div>

        <div class="row g-4">

            <!-- CARD 1 -->
            <div class="col-lg-4 col-md-6">

                <div class="process-card">

                    <div class="icon-circle">
                        1
                    </div>

                    <h4>
                        Pendaftaran
                    </h4>

                    <p>
                        Isi formulir pendaftaran mahasiswa baru
                        secara online dengan mudah.
                    </p>

                    <a href="pages/admission.php"
                    class="btn-main">

                        Buka

                    </a>

                </div>

            </div>

            <!-- CARD 2 -->
            <div class="col-lg-4 col-md-6">

                <div class="process-card">

                    <div class="icon-circle">
                        2
                    </div>

                    <h4>
                        Seleksi Berkas
                    </h4>

                    <p>
                        Verifikasi dokumen dan validasi data
                        oleh pihak universitas.
                    </p>

                    <a href="pages/review.php"
                    class="btn-main">

                        Buka

                    </a>

                </div>

            </div>

            <!-- CARD 3 -->
            <div class="col-lg-4 col-md-6">

                <div class="process-card">

                    <div class="icon-circle">
                        3
                    </div>

                    <h4>
                        Ujian Masuk
                    </h4>

                    <p>
                        Mengikuti tes seleksi penerimaan
                        mahasiswa baru.
                    </p>

                    <a href="pages/exam.php"
                    class="btn-main">

                        Buka

                    </a>

                </div>

            </div>

            <!-- CARD 4 -->
            <div class="col-lg-4 col-md-6">

                <div class="process-card">

                    <div class="icon-circle">
                        4
                    </div>

                    <h4>
                        Pengumuman
                    </h4>

                    <p>
                        Melihat hasil kelulusan mahasiswa baru
                        secara online.
                    </p>

                    <a href="pages/result.php"
                    class="btn-main">

                        Buka

                    </a>

                </div>

            </div>

            <!-- CARD 5 -->
            <div class="col-lg-4 col-md-6">

                <div class="process-card">

                    <div class="icon-circle">
                        5
                    </div>

                    <h4>
                        Daftar Ulang
                    </h4>

                    <p>
                        Registrasi ulang dan pembayaran
                        administrasi kampus.
                    </p>

                    <a href="pages/reenrollment.php"
                    class="btn-main">

                        Buka

                    </a>

                </div>

            </div>

            <!-- CARD 6 -->
            <div class="col-lg-4 col-md-6">

                <div class="process-card">

                    <div class="icon-circle">
                        6
                    </div>

                    <h4>
                        OSPEK
                    </h4>

                    <p>
                        Pengenalan lingkungan kampus dan
                        kegiatan mahasiswa baru.
                    </p>

                    <a href="pages/ospek.php"
                    class="btn-main">

                        Buka

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ABOUT -->
<section id="tentang"
class="py-5">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <img src="assets/img/hero.jpg"
                class="img-fluid rounded-5 shadow">

            </div>

            <div class="col-lg-6">

                <div class="ps-lg-5 mt-5 mt-lg-0">

                    <h2 class="fw-bold mb-4">

                        Sistem Pendaftaran Modern

                    </h2>

                    <p class="text-secondary">

                        Website ini dirancang untuk membantu proses
                        penerimaan mahasiswa baru menjadi lebih cepat,
                        efisien, dan profesional.

                    </p>

                    <p class="text-secondary">

                        Dengan tampilan modern dan sistem terintegrasi,
                        mahasiswa dapat melakukan seluruh proses
                        pendaftaran secara online.

                    </p>

                    <a href="#alur"
                    class="btn-main mt-3">

                        Daftar Sekarang

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="footer"
id="kontak">

    <div class="container">

        <div class="row">

            <div class="col-lg-6">

                <h4 class="fw-bold text-primary">

                    UNIVERSITAS NEGERI UBM

                </h4>

                <p class="text-secondary mt-3">

                    Sistem pendaftaran mahasiswa baru
                    modern dan profesional.

                </p>

            </div>

            <div class="col-lg-6 text-lg-end">

                <p class="text-secondary">

                    Email: admin@universitas.ac.id

                </p>

                <p class="text-secondary">

                    Telp: 08123456789

                </p>
            </div>
        </div>
        <hr>
        <div class="text-center">

            <p class="text-secondary mb-0">

                © 2026 Universitas Negeri UBM. All Rights Reserved.

            </p>

        </div>

    </div>

</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>