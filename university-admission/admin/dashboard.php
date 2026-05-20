<?php
include '../config.php';

/* TOTAL MAHASISWA */
$query_mahasiswa = mysqli_query(
$conn,
"SELECT * FROM mahasiswa"
);

$total_mahasiswa = mysqli_num_rows(
$query_mahasiswa
);

/* TOTAL PEMBAYARAN */
$query_pembayaran = mysqli_query(
$conn,
"SELECT * FROM pembayaran"
);

$total_pembayaran = mysqli_num_rows(
$query_pembayaran
);

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet"
    href="../assets/css/style.css">

    <style>

        body{
            background: #f1f5f9;
            overflow-x: hidden;
        }

        /* SIDEBAR */

        .sidebar{

            width: 270px;
            height: 100vh;

            background:
            linear-gradient(
            180deg,
            #1e3a8a,
            #2563eb);

            position: fixed;

            left: 0;
            top: 0;

            padding: 30px 20px;

            color: white;

        }

        .sidebar h3{

            font-weight: 700;
            margin-bottom: 40px;

        }

        .sidebar a{

            display: flex;
            align-items: center;
            gap: 12px;

            padding: 14px 18px;

            color: white;

            text-decoration: none;

            border-radius: 14px;

            margin-bottom: 10px;

            transition: 0.3s;

            font-weight: 500;

        }

        .sidebar a:hover{

            background: rgba(255,255,255,0.15);

            transform: translateX(5px);

        }

        /* MAIN */

        .main{

            margin-left: 270px;

            padding: 40px;

        }

        /* TOPBAR */

        .topbar{

            background: white;

            padding: 20px 30px;

            border-radius: 24px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            box-shadow:
            0 10px 30px rgba(0,0,0,0.05);

            margin-bottom: 40px;

        }

        .admin-profile{

            display: flex;
            align-items: center;
            gap: 15px;

        }

        .admin-avatar{

            width: 50px;
            height: 50px;

            background: #2563eb;

            border-radius: 50%;

            display: flex;
            justify-content: center;
            align-items: center;

            color: white;
            font-weight: bold;

        }

        /* CARD */

        .dashboard-card{

            background: white;

            padding: 35px;

            border-radius: 28px;

            position: relative;

            overflow: hidden;

            box-shadow:
            0 15px 35px rgba(0,0,0,0.05);

            transition: 0.4s;

            height: 100%;

        }

        .dashboard-card:hover{

            transform: translateY(-8px);

        }

        .dashboard-card::before{

            content: '';

            width: 140px;
            height: 140px;

            background:
            rgba(37,99,235,0.08);

            position: absolute;

            right: -40px;
            top: -40px;

            border-radius: 50%;

        }

        .card-icon{

            width: 70px;
            height: 70px;

            background:
            linear-gradient(
            135deg,
            #2563eb,
            #1e40af);

            border-radius: 20px;

            display: flex;
            justify-content: center;
            align-items: center;

            color: white;

            font-size: 28px;

            margin-bottom: 25px;

        }

        .dashboard-card h1{

            font-size: 52px;
            font-weight: 800;

        }

        .dashboard-card p{

            color: #64748b;

        }

        /* TABLE */

        .table-card{

            background: white;

            padding: 30px;

            border-radius: 28px;

            box-shadow:
            0 10px 25px rgba(0,0,0,0.05);

            margin-top: 40px;

        }

        .table th{

            background: #2563eb;
            color: white;

        }

        .badge-status{

            padding: 10px 16px;

            border-radius: 50px;

            font-size: 13px;

        }

        /* RESPONSIVE */

        @media(max-width:992px){

            .sidebar{

                width: 100%;
                height: auto;

                position: relative;

            }

            .main{

                margin-left: 0;

            }

        }

    </style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h3>

        🎓 ADMIN PMB

    </h3>

    <a href="dashboard.php">

        <i class="bi bi-grid-fill"></i>
        Dashboard

    </a>

    <a href="mahasiswa.php">

        <i class="bi bi-people-fill"></i>
        Mahasiswa

    </a>

    <a href="pembayaran.php">

        <i class="bi bi-credit-card-fill"></i>
        Pembayaran

    </a>

    <a href="ujian.php">

        <i class="bi bi-journal-text"></i>
        Ujian

    </a>

    <a href="../index.php">

        <i class="bi bi-box-arrow-left"></i>
        Keluar

    </a>

</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">

        <div>

            <h3 class="fw-bold mb-1">

                Dashboard Admin

            </h3>

            <p class="text-secondary mb-0">

                Sistem Penerimaan Mahasiswa Baru

            </p>

        </div>

        <div class="admin-profile">

            <div>

                <h6 class="mb-0 fw-bold">

                    Administrator

                </h6>

                <small class="text-secondary">

                    Online

                </small>

            </div>

            <div class="admin-avatar">

                A

            </div>

        </div>

    </div>

    <!-- CARDS -->
    <div class="row g-4">

        <!-- MAHASISWA -->
        <div class="col-lg-6">

            <div class="dashboard-card">

                <div class="card-icon">

                    <i class="bi bi-people-fill"></i>

                </div>

                <p>Total Mahasiswa</p>

                <h1>

                    <?php echo $total_mahasiswa; ?>

                </h1>

            </div>

        </div>

        <!-- PEMBAYARAN -->
        <div class="col-lg-6">

            <div class="dashboard-card">

                <div class="card-icon">

                    <i class="bi bi-wallet2"></i>

                </div>

                <p>Total Pembayaran</p>

                <h1>

                    <?php echo $total_pembayaran; ?>

                </h1>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="table-card">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold">

                Data Mahasiswa Terbaru

            </h4>

        </div>

        <table class="table table-hover align-middle">

            <thead>

                <tr>

                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                <?php

                $mahasiswa = mysqli_query(
                $conn,
                "SELECT * FROM mahasiswa
                ORDER BY id DESC
                LIMIT 5"
                );

                while($m = mysqli_fetch_array($mahasiswa)){

                ?>

                <tr>

                    <td>

                        <?php echo $m['nama_lengkap']; ?>

                    </td>

                    <td>

                        <?php echo $m['email']; ?>

                    </td>

                    <td>

                        <span class="badge bg-success badge-status">

                            Aktif

                        </span>

                    </td>

                </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>