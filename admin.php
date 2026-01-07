<?php
// WAJIB: Memulai sesi
session_start();

// WAJIB: Memulai koneksi ke database
include "koneksi.php";

// CEK LOGIN
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// DAFTAR HALAMAN YANG DIIZINKAN
$allowed_pages = ['dashboard', 'article'];
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// VALIDASI HALAMAN
if (!in_array($page, $allowed_pages)) {
    $page = 'dashboard';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Daily Journal | Kuronaku (Admin)</title>

  <!-- Favicon -->
  <link rel="icon" href="img/logo.png">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- NAVBAR BEGIN -->
<nav class="navbar navbar-expand-sm bg-danger-subtle sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="admin.php">
      My Daily Journal
    </a>

    <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <li class="nav-item">
            <a class="nav-link" href="admin.php?page=dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin.php?page=article">Article</a>
        </li>

        <!-- DROPDOWN USER -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold text-danger"
             href="#"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">
            <?= htmlspecialchars($_SESSION['username']); ?>
          </a>

          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item text-danger" href="logout.php">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>
<!-- NAVBAR END -->

<!-- CONTENT -->
<main class="container my-5 flex-fill">
    <h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">
        <?= htmlspecialchars($page) ?>
    </h4>

    <?php
    // Sertakan file sesuai halaman yang valid
    include($page . ".php");
    ?>
</main>

<!-- FOOTER BEGIN -->
<footer class="bg-danger-subtle text-center py-4 mt-auto">
  <div class="mb-2">
    <a href="https://www.instagram.com/zakyinspot_1/"
       target="_blank"
       class="text-dark fs-4 me-3 text-decoration-none">
      <i class="bi bi-instagram"></i>
    </a>

    <a href="https://twitter.com/udinusofficial"
       target="_blank"
       class="text-dark fs-4 me-3 text-decoration-none">
      <i class="bi bi-twitter"></i>
    </a>

    <a href="https://wa.me/+62812685577"
       target="_blank"
       class="text-dark fs-4 text-decoration-none">
      <i class="bi bi-whatsapp"></i>
    </a>
  </div>

  <div class="text-muted small">
    Kumara Zaki Hibrizy &copy; 2025 | All Rights Reserved.
  </div>
</footer>
<!-- FOOTER END -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

</body>
</html>
