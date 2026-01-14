<?php
include "koneksi.php";

$keyword = '';
if (isset($_POST['keyword'])) {
    $keyword = $conn->real_escape_string($_POST['keyword']);
}

$sql = "SELECT * FROM gallery
        WHERE deskripsi LIKE '%$keyword%'
        ORDER BY tanggal DESC";

$hasil = $conn->query($sql);
$no = 1;

while ($row = $hasil->fetch_assoc()):
?>
<tr>
    <td><?= $no++ ?></td>

    <td>
        <strong><?= htmlspecialchars($row["deskripsi"] ?? '') ?></strong><br>
        Pada: <?= htmlspecialchars($row["tanggal"] ?? '') ?><br>
        Oleh: <?= htmlspecialchars($row["username"] ?? '') ?>
    </td>

    <td>
        <?php if (!empty($row["gambar"]) && file_exists($row["gambar"])): ?>
            <img src="<?= $row["gambar"] ?>" class="img-fluid" style="max-height:100px;">
        <?php else: ?>
            Tidak ada gambar
        <?php endif; ?>
    </td>

    <td>
        <a href="#" class="badge rounded-pill text-bg-success"
           data-bs-toggle="modal"
           data-bs-target="#modalEdit<?= $row["id"] ?>">
            <i class="bi bi-pencil"></i>
        </a>

        <a href="#" class="badge rounded-pill text-bg-danger"
           data-bs-toggle="modal"
           data-bs-target="#modalHapus<?= $row["id"] ?>">
            <i class="bi bi-x-circle"></i>
        </a>
    </td>
</tr>

<!-- ================= MODAL EDIT ================= -->
<div class="modal fade" id="modalEdit<?= $row["id"] ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Gallery</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi"
                               class="form-control"
                               value="<?= htmlspecialchars($row["deskripsi"]) ?>">
                    </div>

                    <div class="mb-3">
                        <label>Ganti Gambar (opsional)</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="edit" class="btn btn-success">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- ================= MODAL HAPUS ================= -->
<div class="modal fade" id="modalHapus<?= $row["id"] ?>" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <form method="post">
                <div class="modal-body text-center">
                    <p>Hapus gallery ini?</p>
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <button class="btn btn-danger btn-sm" name="hapus">Hapus</button>
                    <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php endwhile; ?>
