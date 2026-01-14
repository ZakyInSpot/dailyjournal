<?php
// Ambil jumlah article
$sql1 = "SELECT * FROM article";
$hasil1 = $conn->query($sql1);
$jumlah_article = $hasil1->num_rows;

// Ambil jumlah gallery
$sql2 = "SELECT * FROM gallery";
$hasil2 = $conn->query($sql2);
$jumlah_gallery = $hasil2->num_rows;
?>

<div class="text-center mb-4">
    <h5 class="text-muted">Selamat Datang,</h5>
    <h3 class="text-danger fw-bold">
        <?= htmlspecialchars($_SESSION['username']); ?>
    </h3>

    <?php if (!empty($_SESSION['foto'])) : ?>
        <img src="<?= $_SESSION['foto']; ?>" 
             class="rounded-circle mt-3"
             width="150"
             height="150"
             style="object-fit: cover;">
    <?php else : ?>
        <p class="text-muted mt-3">Belum ada foto</p>
    <?php endif; ?>
</div>

<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">
    <div class="col">
        <div class="card border border-danger shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5><i class="bi bi-newspaper"></i> Article</h5>
                <span class="badge rounded-pill text-bg-danger fs-2">
                    <?= $jumlah_article; ?>
                </span>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card border border-danger shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5><i class="bi bi-camera"></i> Gallery</h5>
                <span class="badge rounded-pill text-bg-danger fs-2">
                    <?= $jumlah_gallery; ?>
                </span>
            </div>
        </div>
    </div>
</div>
