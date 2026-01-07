<?php
include "koneksi.php"; // pastikan $conn tersedia

$keyword = '';
if (isset($_POST['keyword'])) {
    $keyword = $conn->real_escape_string($_POST['keyword']);
}

$sql = "SELECT * FROM article 
        WHERE judul LIKE '%$keyword%' OR isi LIKE '%$keyword%' 
        ORDER BY tanggal DESC";
$hasil = $conn->query($sql);
$no = 1;

while ($row = $hasil->fetch_assoc()):
?>
<tr>
    <td><?= $no++ ?></td>
    <td>
        <strong><?= htmlspecialchars($row["judul"]) ?></strong><br>
        Pada: <?= htmlspecialchars($row["tanggal"]) ?><br>
        Oleh: <?= htmlspecialchars($row["username"]) ?>
    </td>
    <td><?= nl2br(htmlspecialchars($row["isi"])) ?></td>
    <td>
        <?php if (!empty($row["gambar"]) && file_exists($row["gambar"])): ?>
            <img src="<?= $row["gambar"] ?>" class="img-fluid" style="max-height:100px;">
        <?php else: ?>
            Tidak ada gambar
        <?php endif; ?>
    </td>
    <td>
        <a href="#" class="badge rounded-pill text-bg-success"
           data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>">
            <i class="bi bi-pencil"></i>
        </a>
        <a href="#" class="badge rounded-pill text-bg-danger"
           data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>">
            <i class="bi bi-x-circle"></i>
        </a>
    </td>
</tr>
<?php endwhile; ?>