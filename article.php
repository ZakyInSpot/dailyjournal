<?php
include "upload_foto.php";
?>

<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <!-- Button tambah -->
            <button type="button" class="btn btn-secondary"
                    data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Tambah Article
            </button>
        </div>

        <div class="col-md-6">
            <!-- SEARCH BOX -->
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Cari Artikel...">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover" id="tableArticle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th class="w-25">Judul</th>
                        <th class="w-50">Isi</th>
                        <th class="w-25">Gambar</th>
                        <th class="w-25">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $sql   = "SELECT * FROM article ORDER BY tanggal DESC";
                $hasil = $conn->query($sql);
                $no    = 1;

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

                    <!-- ================= MODAL EDIT ================= -->
                    <div class="modal fade" id="modalEdit<?= $row["id"] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Article</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <form method="post" enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">

                                        <div class="mb-3">
                                            <label>Judul</label>
                                            <input type="text" name="judul" class="form-control"
                                                   value="<?= htmlspecialchars($row["judul"]) ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Isi</label>
                                            <textarea name="isi" class="form-control" rows="4" required><?= htmlspecialchars($row["isi"]) ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label>Ganti Gambar (opsional)</label>
                                            <input type="file" name="gambar" class="form-control">
                                        </div>

                                        <?php if (!empty($row["gambar"]) && file_exists($row["gambar"])): ?>
                                            <img src="<?= $row["gambar"] ?>" class="img-fluid mt-2" style="max-height:100px;">
                                        <?php endif; ?>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- ================= MODAL HAPUS ================= -->
                    <div class="modal fade" id="modalHapus<?= $row["id"] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Article</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <form method="post">
                                    <div class="modal-body">
                                        Yakin ingin menghapus artikel
                                        <strong><?= htmlspecialchars($row["judul"]) ?></strong>?
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Isi</label>
                        <textarea name="isi" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ================= JQUERY AJAX SEARCH ================= -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {
    $("#search").on("keyup", function () {
        let keyword = $(this).val();

        $.ajax({
            url: "article_search.php",
            type: "POST",
            data: { keyword: keyword },
            success: function(response) {
                $("#tableArticle tbody").html(response);
            },
            error: function() {
                alert("Terjadi kesalahan saat mencari artikel.");
            }
        });
    });
});
</script>

<?php
// ================= INSERT =================
if (isset($_POST['simpan'])) {

    $judul    = $_POST['judul'];
    $isi      = $_POST['isi'];
    $tanggal  = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar   = '';

    if (!empty($_FILES['gambar']['name'])) {
        $upload = upload_foto($_FILES['gambar']);
        if ($upload['status']) {
            $gambar = $upload['message'];
        } else {
            echo "<script>alert('".$upload['message']."');</script>";
            return;
        }
    }

    $stmt = $conn->prepare(
        "INSERT INTO article (judul, isi, gambar, tanggal, username)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssss", $judul, $isi, $gambar, $tanggal, $username);
    $stmt->execute();

    echo "<script>alert('Artikel berhasil ditambahkan');location.href='admin.php?page=article';</script>";
}

// ================= UPDATE =================
if (isset($_POST['update'])) {

    $id    = $_POST['id'];
    $judul = $_POST['judul'];
    $isi   = $_POST['isi'];

    $gambar = $_POST['gambar_lama'];

    if (!empty($_FILES['gambar']['name'])) {
        $upload = upload_foto($_FILES['gambar']);
        if ($upload['status']) {
            $gambar = $upload['message'];
        } else {
            echo "<script>alert('".$upload['message']."');</script>";
            return;
        }
    }

    $stmt = $conn->prepare(
        "UPDATE article SET judul=?, isi=?, gambar=? WHERE id=?"
    );
    $stmt->bind_param("sssi", $judul, $isi, $gambar, $id);
    $stmt->execute();

    echo "<script>alert('Artikel berhasil diupdate');location.href='admin.php?page=article';</script>";
}

// ================= DELETE =================
if (isset($_POST['hapus'])) {

    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM article WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<script>alert('Artikel berhasil dihapus');location.href='admin.php?page=article';</script>";
}
?>
