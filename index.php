<?php
//menyertakan code dari file koneksi
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Website Jurnal Harian - Catat semua kegiatan sehari-hari tanpa terkecuali" />
  <meta name="author" content="Kumara Zaki Hibrizy" />
  <title>My Daily Journal - Kuronaku</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --primary: #0d47a1;
      --primary-light: #1565c0;
      --primary-dark: #0a3570;
      --secondary: #e53935;
      --accent: #ff9800;
      --light-bg: #f8f9fa;
      --dark-text: #212529;
      --light-text: #f8f9fa;
      --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --transition: all 0.3s ease;
      
      /* Additional variables for better theme control */
      --card-bg: #ffffff;
      --section-bg: #ffffff;
      --muted-text: #6c757d;
      --border-color: #e0e0e0;
    }

    /* Dark Theme Variables */
    [data-theme="dark"] {
      --light-bg: #121212;
      --dark-text: #e0e0e0;
      --shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      --card-bg: #1e1e1e;
      --section-bg: #1e1e1e;
      --muted-text: #a0a0a0;
      --border-color: #444444;
    }
    
    html {
      scroll-behavior: smooth;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--light-bg);
      color: var(--dark-text);
      line-height: 1.7;
      transition: var(--transition);
    }
    
    /* PERBAIKAN: Hanya terapkan warna dark-text untuk elemen umum */
    h1, h2, h3, h4, h5, h6 {
      font-family: 'Montserrat', sans-serif;
      font-weight: 600;
      color: var(--dark-text);
    }
    
    /* PERBAIKAN: Kecualikan hero section dari warna dark-text */
    .hero-section h1,
    .hero-section h2,
    .hero-section h3,
    .hero-section h4,
    .hero-section h5,
    .hero-section h6,
    .hero-section p,
    .hero-section span {
      color: var(--light-text) !important;
    }
    
    section {
      padding: 80px 0;
      background-color: var(--section-bg);
      transition: var(--transition);
    }
    
    /* PERBAIKAN: Override untuk section dengan class bg-light */
    .bg-light {
      background-color: var(--light-bg) !important;
    }
    
    /* NAVBAR */
    .navbar {
      background: linear-gradient(90deg, var(--primary-dark), var(--primary));
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 15px 0;
      transition: var(--transition);
    }
    
    .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: var(--light-text) !important;
    }
    
    .navbar-nav .nav-link {
      color: var(--light-text) !important;
      font-weight: 500;
      margin: 0 10px;
      position: relative;
      transition: var(--transition);
    }
    
    .navbar-nav .nav-link:hover {
      color: var(--accent) !important;
    }
    
    .navbar-nav .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: var(--accent);
      transition: var(--transition);
    }
    
    .navbar-nav .nav-link:hover::after {
      width: 100%;
    }
    
    /* Theme Toggle Switch */
    .theme-toggle {
      display: flex;
      align-items: center;
      margin-left: 15px;
    }
    
    .theme-toggle-label {
      display: flex;
      align-items: center;
      cursor: pointer;
      position: relative;
    }
    
    .theme-toggle-checkbox {
      opacity: 0;
      position: absolute;
      width: 0;
      height: 0;
    }
    
    .theme-toggle-slider {
      width: 50px;
      height: 24px;
      background-color: rgba(255, 255, 255, 0.3);
      border-radius: 34px;
      position: relative;
      transition: var(--transition);
      margin-right: 8px;
    }
    
    .theme-toggle-slider:before {
      content: "";
      position: absolute;
      height: 18px;
      width: 18px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      border-radius: 50%;
      transition: var(--transition);
    }
    
    .theme-toggle-checkbox:checked + .theme-toggle-slider {
      background-color: var(--accent);
    }
    
    .theme-toggle-checkbox:checked + .theme-toggle-slider:before {
      transform: translateX(26px);
    }
    
    .theme-toggle-icon {
      font-size: 1.2rem;
      color: var(--light-text);
    }
    
    /* HERO SECTION - PERBAIKAN KHUSUS */
    .hero-section {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
      padding: 120px 0 80px;
      color: var(--light-text) !important; /* Pastikan warna teks putih */
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    
    .hero-section *:not(.theme-toggle-checkbox) {
      color: var(--light-text) !important; /* Force semua teks di hero menjadi putih */
    }
    
    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,261.3C672,256,768,224,864,197.3C960,171,1056,149,1152,165.3C1248,181,1344,235,1392,261.3L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
      background-size: cover;
      background-position: bottom;
    }
    
    .hero-title {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
      color: var(--light-text) !important; /* Pastikan judul tetap putih */
    }
    
    .hero-tagline {
      font-size: 1.5rem;
      margin-bottom: 30px;
      font-weight: 300;
      color: var(--light-text) !important; /* Pastikan tagline tetap putih */
    }
    
    .hero-logo-container {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 30px;
    }
    
    .hero-logo-img {
      width: 80px;
      height: auto;
      margin-right: 15px;
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
    }
    
    .hero-timestamp {
      font-size: 1.1rem;
      margin-top: 40px;
      background-color: rgba(255, 255, 255, 0.2);
      display: inline-block;
      padding: 10px 20px;
      border-radius: 50px;
      backdrop-filter: blur(5px);
      color: var(--light-text) !important; /* Pastikan timestamp tetap putih */
    }
    
    /* CARD STYLING */
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: var(--shadow);
      transition: var(--transition);
      overflow: hidden;
      background-color: var(--card-bg);
      color: var(--dark-text);
    }
    
    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }
    
    .card-header {
      background: linear-gradient(90deg, var(--primary), var(--primary-light));
      color: var(--light-text);
      border: none;
      padding: 15px 20px;
      font-weight: 600;
    }
    
    /* SECTION HEADINGS */
    .section-heading {
      position: relative;
      margin-bottom: 50px;
      text-align: center;
      color: var(--dark-text);
    }
    
    .section-heading::after {
      content: '';
      position: absolute;
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--accent));
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
      border-radius: 2px;
    }
    
    /* Text colors */
    .text-muted {
      color: var(--muted-text) !important;
    }
    
    /* IDENTITAS SECTION */
    #identitas .card {
      background: linear-gradient(135deg, var(--card-bg) 0%, var(--light-bg) 100%);
      border-left: 5px solid var(--primary);
    }
    
    /* GALLERY - PERBAIKAN: Pastikan caption selalu terlihat */
    .gallery-item {
      position: relative;
      overflow: hidden;
      border-radius: 12px;
      box-shadow: var(--shadow);
      transition: var(--transition);
    }
    
    .gallery-item img {
      transition: var(--transition);
      width: 100%;
      height: 250px;
      object-fit: cover;
    }
    
    .gallery-item:hover img {
      transform: scale(1.08);
    }
    
    .gallery-caption {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
      color: white !important; /* PERBAIKAN: Pastikan teks caption selalu putih */
      padding: 20px 15px 10px;
      transform: translateY(100%);
      transition: var(--transition);
    }
    
    /* PERBAIKAN: Pastikan judul di gallery caption selalu putih */
    .gallery-caption h5 {
      color: white !important;
      font-weight: 600;
      margin: 0;
    }
    
    .gallery-item:hover .gallery-caption {
      transform: translateY(0);
    }
    
    /* SCHEDULE SECTION */
    #schedule {
      background: linear-gradient(135deg, var(--light-bg) 0%, var(--section-bg) 100%);
    }
    
    #schedule .card {
      background: linear-gradient(135deg, var(--card-bg) 0%, var(--light-bg) 100%);
      border-top: 4px solid var(--primary);
      transition: var(--transition);
    }
    
    #schedule .card:hover {
      border-top-color: var(--accent);
    }
    
    #schedule .card-body {
      padding: 30px 20px;
    }
    
    #schedule .card-title {
      color: var(--primary);
      font-weight: 600;
    }
    
    /* ABOUT ME SECTION */
    #about {
      background: linear-gradient(135deg, var(--light-bg) 0%, var(--section-bg) 100%);
    }
    
    .accordion {
      --bs-accordion-bg: var(--card-bg);
      --bs-accordion-color: var(--dark-text);
      --bs-accordion-border-color: var(--border-color);
    }
    
    .accordion-button {
      font-weight: 600;
      padding: 15px 20px;
      background-color: var(--card-bg);
      color: var(--dark-text);
      border-bottom: 1px solid var(--border-color);
    }
    
    .accordion-button:not(.collapsed) {
      background-color: var(--primary);
      color: white;
    }
    
    .accordion-button:focus {
      box-shadow: 0 0 0 0.25rem rgba(13, 71, 161, 0.25);
      border-color: var(--primary);
    }
    
    .accordion-body {
      background-color: var(--card-bg);
      color: var(--dark-text);
    }
    
    /* CONTACT FORM */
    #kontak {
      background-color: var(--section-bg);
    }
    
    .form-control, .form-select {
      border-radius: 8px;
      padding: 12px 15px;
      border: 1px solid var(--border-color);
      transition: var(--transition);
      background-color: var(--card-bg);
      color: var(--dark-text);
    }
    
    .form-control:focus, .form-select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 0.25rem rgba(13, 71, 161, 0.25);
    }
    
    .form-label {
      color: var(--dark-text);
    }
    
    /* BUTTONS */
    .btn-primary {
      background-color: var(--primary);
      border: none;
      border-radius: 8px;
      padding: 12px 30px;
      font-weight: 500;
      transition: var(--transition);
    }
    
    .btn-primary:hover {
      background-color: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(13, 71, 161, 0.3);
    }
    
    .btn-secondary {
      background-color: #6c757d;
      border: none;
      border-radius: 8px;
      padding: 12px 30px;
      font-weight: 500;
      transition: var(--transition);
    }
    
    .btn-secondary:hover {
      background-color: #5a6268;
      transform: translateY(-2px);
    }
    
    /* FOOTER */
    footer {
      background: linear-gradient(90deg, var(--primary-dark), var(--primary));
      color: var(--light-text);
      padding: 40px 0 20px;
    }
    
    footer p {
      margin: 0;
      opacity: 0.8;
    }
    
    /* BACK TO TOP BUTTON */
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      background-color: var(--primary);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      box-shadow: var(--shadow);
      z-index: 1000;
      opacity: 0;
      visibility: hidden;
      transition: var(--transition);
      text-decoration: none;
    }
    
    .back-to-top.active {
      opacity: 1;
      visibility: visible;
    }
    
    .back-to-top:hover {
      background-color: var(--primary-dark);
      transform: translateY(-3px);
      color: white;
    }
    
    /* Address styling */
    address p {
      color: var(--dark-text);
    }
    
    /* RESPONSIVE STYLES */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .hero-tagline {
        font-size: 1.2rem;
      }
      
      section {
        padding: 60px 0;
      }
      
      .navbar-collapse {
        background: linear-gradient(90deg, var(--primary-dark), var(--primary));
        padding: 15px;
        border-radius: 0 0 10px 10px;
        margin-top: 10px;
      }
      
      .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
      }
      
      .theme-toggle {
        margin-left: 0;
        margin-top: 10px;
        justify-content: center;
      }
    }
  </style>
</head>

<body>
  <!-- HEADER + NAVBAR -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Kuronaku</a>
        
        <!-- Tombol Hamburger untuk Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Menu Navigasi -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#identitas">Identitas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#artikel">Artikel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Galeri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#schedule">Schedule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About Me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#kontak">Kontak</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php" target="_blank">Login</a>
            </li>
          </ul>
          
          <!-- Theme Toggle Switch -->
          <div class="theme-toggle">
            <label class="theme-toggle-label">
              <input type="checkbox" class="theme-toggle-checkbox">
              <span class="theme-toggle-slider"></span>
              <span class="theme-toggle-icon">
                <i class="bi bi-moon-fill"></i>
              </span>
            </label>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <!-- HERO SECTION -->
  <section id="home" class="hero-section">
    <div class="container">
      <div class="hero-logo-container">
        <img src="img/ChatGPT Image Nov 26, 2025, 07_33_44 AM.png" alt="Kuronaku Logo" class="hero-logo-img">
        <h1 class="hero-title">Kuronaku</h1>
      </div>
      
      <div class="hero-tagline">
        Watch Anime, Manga, or Manhwa in One Place Anytime and Anywhere with Ease
      </div>
      
      <div class="hero-timestamp">
        <span id="tanggal"></span> | <span id="jam"></span>
      </div>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <main>
    <!-- IDENTITAS SECTION -->
    <section id="identitas">
      <div class="container">
        <h2 class="section-heading">Identitas Mahasiswa</h2>
        <div class="card p-4">
          <div class="row align-items-center">
            <!-- Teks identitas -->
            <div class="col-md-8 text-center text-md-start">
              <p><strong>Nama:</strong> Kumara Zaki Hibrizy</p>
              <p><strong>NIM:</strong> A11.2024.15688</p>
              <p><strong>Universitas:</strong> Universitas Dian Nuswantoro</p>
              <p><strong>Jurusan:</strong> Teknik Informatika S1</p>
              <p><strong>Hobi:</strong> Menonton anime, membaca manga, dan menulis review.</p>
            </div>
            
            <!-- Gambar mahasiswa -->
            <div class="col-md-4 text-center mt-4 mt-md-0">
              <img src="KUMARA 4X6.jpg" alt="Foto Mahasiswa" class="img-fluid rounded shadow" style="max-width: 200px;">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ARTIKEL SECTION - PERBAIKAN: bg-light diubah untuk tema gelap -->
<?php
$sql = "SELECT * FROM article ORDER BY tanggal DESC LIMIT 1";
$hasil = $conn->query($sql);
$article = $hasil->fetch_assoc();
?>

<!-- ARTIKEL SECTION -->
<section id="artikel" class="bg-light py-5">
  <div class="container">
    <h2 class="section-heading text-center mb-4">
      Artikel Anime & Manga
    </h2>

    <div class="row">

      <!-- ARTIKEL DINAMIS -->
      <div class="col-lg-6 mb-5">
        <?php if ($article) { ?>
        <article class="card h-100 shadow-sm">
          <div class="card-header fw-bold text-center">
            <?= htmlspecialchars($article['judul']); ?>
          </div>

          <div class="card-body">

            <p class="text-muted text-center mb-2">
              <small>
                Diposting pada 
                <?= date('d F Y, H:i', strtotime($article['tanggal'])); ?> WIB
              </small>
            </p>

            <figure class="text-center mb-3">
              <img 
                src="<?= htmlspecialchars($article['gambar']); ?>" 
                class="img-fluid rounded shadow-sm"
                alt="<?= htmlspecialchars($article['judul']); ?>"
              />
            </figure>

            <p><?= nl2br(htmlspecialchars($article['isi'])); ?></p>
          </div>
        </article>
        <?php } ?>
      </div>

      <!-- BERITA -->
      <div class="col-lg-6 mb-5">
        <article class="card h-100">
          <div class="card-header">
            Berita: Anime Terbaru Musim Ini
          </div>
          <div class="card-body">
            <ol class="ps-3">
              <li>One Piece – Egghead Arc</li>
              <li>Spy x Family Season 3</li>
              <li>Record of Ragnarok Season 3</li>
              <li>My Hero Academia Final Season</li>
              <li>Kaiju No. 8 Season 2</li>
              <li>Dandadan Season 2</li>
              <li>The Apothecary Diaries Season 2</li>
            </ol>
          </div>
        </article>
      </div>

      <!-- TUTORIAL -->
      <div class="col-lg-6 mb-5">
        <article class="card h-100">
          <div class="card-header">
            Tutorial: Cara Membaca Manga untuk Pemula
          </div>
          <div class="card-body">
            <ul class="ps-3">
              <li>Baca manga dari kanan ke kiri.</li>
              <li>Perhatikan urutan panel.</li>
              <li>Pahami simbol khas manga.</li>
              <li>Baca dialog sesuai urutan.</li>
              <li>Perhatikan ekspresi karakter.</li>
            </ul>
          </div>
        </article>
      </div>

      <!-- REVIEW -->
      <div class="col-lg-6 mb-5">
        <article class="card h-100 shadow-sm">
          <div class="card-header fw-bold">
            My Status as an Assassin Obviously Exceeds the Hero's
          </div>
          <div class="card-body">
            <p>
              Cerita ini menghadirkan protagonis yang tenang, strategis,
              dan mematikan dengan pendekatan matang.
            </p>
          </div>
        </article>
      </div>

    </div>
  </div>
</section>

    <!-- GALERI SECTION -->
<section id="gallery">
  <div class="container">
    <h2 class="section-heading">Galeri Anime & Manga Jepang</h2>
    <p class="text-center text-muted mb-5">
      Koleksi gambar anime dan manga favorit admin.
    </p>

    <div class="row g-4">
      <?php
      $sql = "SELECT * FROM gallery 
              ORDER BY tanggal DESC 
              LIMIT 9";
      $hasil = $conn->query($sql);

      while ($row = $hasil->fetch_assoc()):
      ?>
        <div class="col-md-4">
          <div class="gallery-item">
            <img 
              src="<?= htmlspecialchars($row['gambar']); ?>" 
              alt="<?= htmlspecialchars($row['deskripsi']); ?>" 
            />
            <div class="gallery-caption">
              <h5><?= htmlspecialchars($row['deskripsi']); ?></h5>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

  </div>
</section>


    <!-- SCHEDULE SECTION - PERBAIKAN: bg-light diubah untuk tema gelap -->
    <section id="schedule" class="bg-light">
      <div class="container">
        <h2 class="section-heading">Schedule Anime</h2>
        <div class="row">
          <div class="col-12 col-sm-6 col-lg-3 mb-4">
            <div class="card h-100 text-center">
              <div class="card-body">
                <div class="mb-3 text-primary fs-1">
                  <i class="bi bi-book"></i>
                </div>
                <h5 class="card-title fw-bold">Senin</h5>
                <p class="card-text">Solo Leveling: Arise of Shadow Monarch</p>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3 mb-4">
            <div class="card h-100 text-center">
              <div class="card-body">
                <div class="mb-3 text-primary fs-1">
                  <i class="bi bi-pencil-square"></i>
                </div>
                <h5 class="card-title fw-bold">Selasa</h5>
                <p class="card-text">Re:Zero Season 3 - Starting Life in Another World</p>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3 mb-4">
            <div class="card h-100 text-center">
              <div class="card-body">
                <div class="mb-3 text-primary fs-1">
                  <i class="bi bi-chat-dots"></i>
                </div>
                <h5 class="card-title fw-bold">Rabu</h5>
                <p class="card-text">Mushoku Tensei: Jobless Reincarnation Part II</p>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3 mb-4">
            <div class="card h-100 text-center">
              <div class="card-body">
                <div class="mb-3 text-primary fs-1">
                  <i class="bi bi-shield-check"></i>
                </div>
                <h5 class="card-title fw-bold">Kamis</h5>
                <p class="card-text">The Rising of the Shield Hero Season 3</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ABOUT ME SECTION -->
    <section id="about">
      <div class="container">
        <h2 class="section-heading">About Me</h2>

        <div class="accordion shadow-sm" id="accordionExample">
          <!-- UNIVERSITAS -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Universitas Dian Nuswantoro Semarang (2024–Now)
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <strong>Mahasiswa Teknik Informatika S1.</strong> 
                Saya mulai kuliah di Universitas Dian Nuswantoro pada tahun 2024. 
                Di sini saya mempelajari dasar pemrograman, algoritma, struktur data, dan pengembangan web.
                Saya juga aktif mengikuti kegiatan kampus yang berhubungan dengan teknologi dan desain UI/UX.
              </div>
            </div>
          </div>

          <!-- SMA -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                SMK Negeri 5 Semarang (2021–2024)
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <strong>Lulusan jurusan TKJ.</strong> 
                Selama di SMK, saya aktif dalam kegiatan ekstrakurikuler teknologi dan komunitas komputer. 
                Saya juga mulai tertarik pada dunia anime, manga, dan pemrograman sejak masa ini.
              </div>
            </div>
          </div>

          <!-- SMP -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                SMP Negeri 11 Semarang (2018–2021)
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <strong>Awal mula ketertarikan terhadap teknologi.</strong> 
                Di masa SMP saya mulai mengenal komputer dan dasar logika pemrograman sederhana, 
                serta mulai menyukai dunia Jepang seperti anime dan manga.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- KONTAK SECTION -->
    <section id="kontak">
      <div class="container">
        <h2 class="section-heading">Form Buku Tamu</h2>
        <p class="text-center text-muted mb-5">Isi form berikut untuk memberikan saran, kritik, atau pengalaman Anda.</p>

        <form class="row g-4">
          <div class="col-md-6">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" required />
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" required />
          </div>

          <div class="col-md-6">
            <label for="telepon" class="form-label">Nomor Telepon</label>
            <input type="tel" class="form-control" id="telepon" />
          </div>
          <div class="col-md-6">
            <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" id="jenis-kelamin">
              <option value="">Pilih</option>
              <option value="laki-laki">Laki-laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
          </div>

          <div class="col-12">
            <label for="pesan" class="form-label">Pesan atau Komentar</label>
            <textarea class="form-control" id="pesan" rows="5"></textarea>
          </div>

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-2">Kirim</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </form>

        <div class="mt-5 text-center">
          <h3 class="mb-4">Informasi Kontak</h3>
          <address>
            <p><i class="bi bi-envelope me-2"></i>Email: umazing@test.com</p>
            <p><i class="bi bi-telephone me-2"></i>Telepon: +6248364790</p>
            <p><i class="bi bi-geo-alt me-2"></i>Alamat: Jl. Harapan Palsu No.123, Jakarta</p>
          </address>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="text-center">
    <div class="container">
      <p>&copy; 2025 My Daily Journal. Dibuat oleh <strong>Kumara Zaki Hibrizy</strong> untuk tugas Pemrograman Web.</p>
    </div>
  </footer>
  
  <!-- BACK TO TOP BUTTON -->
  <a href="#" class="back-to-top">
    <i class="bi bi-arrow-up"></i>
  </a>
  
  <!-- Bootstrap JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- AREA JAVASCRIPT -->
  <script>
    // Fungsi untuk menampilkan waktu
    function tampilWaktu() {
      const waktu = new Date();
      const tanggal = waktu.getDate();
      const bulan = waktu.getMonth();
      const tahun = waktu.getFullYear();
      const jam = String(waktu.getHours()).padStart(2, '0');      //Saya menambahkan padStart(2, '0') untuk memastikan bahwa jam memiliki dua digit
      const menit = String(waktu.getMinutes()).padStart(2, '0');  //Ini juga memastikan bahwa menit memiliki dua digit
      const detik = String(waktu.getSeconds()).padStart(2, '0');  //Ini juga memastikan bahwa detik memiliki dua digit
      
      const arrBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", 
                        "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

      const tanggal_full = tanggal + " " + arrBulan[bulan] + " " + tahun;
      const jam_full = jam + ":" + menit + ":" + detik;

      document.getElementById("tanggal").innerHTML = tanggal_full;
      document.getElementById("jam").innerHTML = jam_full;
    }

    // Panggil fungsi tampilWaktu setiap detik
    setInterval(tampilWaktu, 1000);
    
    // Panggil sekali saat halaman dimuat
    tampilWaktu();
    
    // Back to top button untuk kembali ke atas
    const backToTopButton = document.querySelector('.back-to-top');
    
    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 300) {
        backToTopButton.classList.add('active');
      } else {
        backToTopButton.classList.remove('active');
      }
    });
    
    backToTopButton.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
    
    // Navbar scroll effect untuk scrolling ke atas
    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.querySelector('.navbar').style.padding = '10px 0';
        document.querySelector('.navbar').style.boxShadow = '0 4px 18px rgba(0, 0, 0, 0.1)';
      } else {
        document.querySelector('.navbar').style.padding = '15px 0';
        document.querySelector('.navbar').style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
      }
    });
    
    //Saya mengambil referensi dari google + youtube untuk tutorial menambahkan theme toggle
    //Untuk mengubah tema menjadi gelap dan terang

    // fungsi Theme Toggle 
    const themeToggle = document.querySelector('.theme-toggle-checkbox');
    const themeIcon = document.querySelector('.theme-toggle-icon i');
    
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
    const currentTheme = localStorage.getItem('theme');
    
    if (currentTheme === 'dark' || (!currentTheme && prefersDarkScheme.matches)) {
      document.documentElement.setAttribute('data-theme', 'dark');
      themeToggle.checked = true;
      themeIcon.className = 'bi bi-sun-fill';
    } else {
      document.documentElement.setAttribute('data-theme', 'light');
      themeToggle.checked = false;
      themeIcon.className = 'bi bi-moon-fill';
    }
    
    themeToggle.addEventListener('change', function() {
      if (this.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
        themeIcon.className = 'bi bi-sun-fill';
      } else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
        themeIcon.className = 'bi bi-moon-fill';
      }
    });
  </script>
</body>
</html>