<?php
include '../config.php';

$data = mysqli_query(
$conn,
"SELECT * FROM mahasiswa
ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Data Mahasiswa</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <style>

        *{
            font-family: 'Poppins', sans-serif;
        }

        body{
            background: #f1f5f9;
        }

        /* HEADER */

        .page-header{

            background:
            linear-gradient(
            135deg,
            #2563eb,
            #1e3a8a);

            border-radius: 30px;

            padding: 40px;

            color: white;

            margin-bottom: 40px;

            position: relative;
            overflow: hidden;

        }

        .page-header::before{

            content: '';

            width: 220px;
            height: 220px;

            background: rgba(255,255,255,0.1);

            position: absolute;

            right: -60px;
            top: -60px;

            border-radius: 50%;

        }

        .page-header h1{

            font-weight: 700;
            font-size: 42px;

        }

        .page-header p{

            opacity: 0.9;
            margin-top: 10px;

        }

        /* TABLE CARD */

        .table-card{

            background: white;

            border-radius: 30px;

            padding: 35px;

            box-shadow:
            0 15px 35px rgba(0,0,0,0.05);

        }

        /* TABLE */

        .table{

            vertical-align: middle;

        }

        .table thead th{

            background: #2563eb !important;

            color: white;

            border: none;

            padding: 18px;

            font-weight: 600;

        }

        .table tbody tr{

            transition: 0.3s;

        }

        .table tbody tr:hover{

            background: #f8fafc;

            transform: scale(1.01);

        }

        .table td{

            padding: 18px;

        }

        /* BADGE */

        .badge-status{

            padding: 10px 18px;

            border-radius: 50px;

            font-size: 13px;

            font-weight: 600;

        }

        /* BUTTON */

        .btn-modern{

            background:
            linear-gradient(
            135deg,
            #2563eb,
            #1d4ed8);

            color: white;

            border: none;

            padding: 12px 24px;

            border-radius: 14px;

            text-decoration: none;

            transition: 0.3s;

            display: inline-flex;
            align-items: center;
            gap: 10px;

            font-weight: 500;

        }

        .btn-modern:hover{

            transform: translateY(-3px);

            color: white;

            box-shadow:
            0 10px 20px rgba(37,99,235,0.3);

        }

        /* SEARCH */

        .search-box{

            position: relative;

        }

        .search-box input{

            height: 55px;

            border-radius: 18px;

            padding-left: 50px;

            border: 1px solid #e2e8f0;

        }

        .search-box i{

            position: absolute;

            top: 18px;
            left: 18px;

            color: #64748b;

        }

        /* RESPONSIVE */

        @media(max-width:768px){

            .page-header h1{

                font-size: 30px;

            }

        }

    </style>

</head>
<body>

<div class="container py-5">

    <!-- HEADER -->
    <div class="page-header">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h1>

                    Data Mahasiswa

                </h1>

                <p>

                    Kelola seluruh data mahasiswa baru

                </p>

            </div>

            <a href="dashboard.php"
            class="btn-modern">

                <i class="bi bi-arrow-left"></i>

                Dashboard

            </a>

        </div>

    </div>

    <!-- SEARCH -->
    <div class="mb-4">

        <div class="search-box">

            <i class="bi bi-search"></i>

            <input type="text"
            class="form-control"
            placeholder="Cari mahasiswa...">

        </div>

    </div>

    <!-- TABLE -->
    <div class="table-card">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Asal Sekolah</th>
                        <th>Status Berkas</th>
                        <th>Status Ujian</th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 1;

                    while($d = mysqli_fetch_array($data)){
                    ?>

                    <tr>

                        <td>

                            <?php echo $no++; ?>

                        </td>

                        <td>

                            <div class="fw-semibold">

                                <?php echo $d['nama_lengkap']; ?>

                            </div>

                        </td>

                        <td>

                            <?php echo $d['email']; ?>

                        </td>

                        <td>

                            <?php echo $d['asal_sekolah']; ?>

                        </td>

                        <td>

                            <?php
                            if($d['status_berkas'] == 'Diterima'){
                            ?>

                            <span class="badge bg-success badge-status">

                                Diterima

                            </span>

                            <?php
                            }elseif($d['status_berkas'] == 'Ditolak'){
                            ?>

                            <span class="badge bg-danger badge-status">

                                Ditolak

                            </span>

                            <?php
                            }else{
                            ?>

                            <span class="badge bg-warning text-dark badge-status">

                                Pending

                            </span>

                            <?php } ?>

                        </td>

                        <td>

                            <?php
                            if($d['status_ujian'] == 'Lulus'){
                            ?>

                            <span class="badge bg-primary badge-status">

                                Lulus

                            </span>

                            <?php
                            }elseif($d['status_ujian'] == 'Tidak Lulus'){
                            ?>

                            <span class="badge bg-danger badge-status">

                                Tidak Lulus

                            </span>

                            <?php
                            }else{
                            ?>

                            <span class="badge bg-secondary badge-status">

                                Belum

                            </span>

                            <?php } ?>

                        </td>

                    </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>