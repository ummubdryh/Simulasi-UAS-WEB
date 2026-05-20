<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg shadow-sm">

  <div class="container">

    <a class="navbar-brand" href="/university-admission/index.php">
      UNIVERSITAS NEGERI UBM 
    </a>

    <button class="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#navbarNav">

      <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav ms-auto">

        <!-- HOME -->
        <li class="nav-item">
          <a class="nav-link" href="/university-admission/index.php">Home</a>
        </li>

        <!-- KONTAK ADMIN -->
        <li class="nav-item">
          <a class="nav-link" href="/university-admission/index.php#kontak">Kontak Admin</a>
        </li>

        <!-- USER AREA -->
        <li class="nav-item ms-3">

          <?php if(!empty($_SESSION['nama'])) { ?>

            <div class="dropdown">

              <a class="nav-link dropdown-toggle d-flex align-items-center"
                 href="#"
                 role="button"
                 data-bs-toggle="dropdown"
                 aria-expanded="false">

                <i class="bi bi-person-circle fs-4 me-1"></i>
                <?= htmlspecialchars($_SESSION['nama']); ?>

              </a>

              <ul class="dropdown-menu dropdown-menu-end">

                <li>
                  <a class="dropdown-item" href="/university-admission/pages/profil.php">
                    Lihat Profil
                  </a>
                </li>

                <li>
                  <a class="dropdown-item" href="/university-admission/index.php#kontak">
                    Kontak Admin
                  </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                  <a class="dropdown-item text-danger" href="/university-admission/auth/logout.php">
                    Logout
                  </a>
                </li>

              </ul>

            </div>

          <?php } else { ?>

            <div class="dropdown">

              <a class="nav-link dropdown-toggle d-flex align-items-center"
                 href="#"
                 role="button"
                 data-bs-toggle="dropdown"
                 aria-expanded="false">

                <i class="bi bi-person-circle fs-4 me-1"></i>
                Profil

              </a>

              <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 260px;">

                <li class="text-danger small mb-2">
                  ⚠ Anda belum login sebagai user
                </li>

                <li class="small mb-2">
                  Silakan registrasi atau login terlebih dahulu.
                </li>

                <li class="small mb-2">
                  Jika ada kendala, hubungi admin.
                </li>

                <li><hr></li>

                <li>
                  <a class="btn btn-primary btn-sm w-100 mb-2" href="/university-admission/auth/register.php">
                    Registrasi
                  </a>
                </li>

                <li>
                  <a class="btn btn-outline-primary btn-sm w-100" href="/university-admission/auth/login.php">
                    Login
                  </a>
                </li>

              </ul>

            </div>

          <?php } ?>

        </li>

      </ul>

    </div>

  </div>

</nav>