<?php
include "upload_gallery.php";
?>

<style>
/* ====== UKURAN GAMBAR GALLERY (ONLY THIS) ====== */
.gallery-img img {
    width: 260px;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
}
</style>

<div class="container">

    <!-- HEADER -->
    <div class="row mb-3 align-items-center">
        <div class="col-md-6">
            <button class="btn btn-secondary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Tambah Gallery
            </button>
        </div>

        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Cari Gallery...">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- LIST GALLERY -->
    <div class="table-responsive">
        <table class="table align-middle" id="tableGallery">
            <thead class="table-dark">
                <tr>
                    <th style="width:5%">No</th>
                    <th style="width:35%">Deskripsi</th>
                    <th style="width:45%">Gambar</th>
                    <th style="width:15%">Aksi</th>
                </tr>
            </thead>

            <!-- 🔥 SATU-SATUNYA SUMBER DATA -->
            <tbody id="tableGalleryBody">
                <?php include "gallery_search.php"; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Gallery</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ================= SEARCH AJAX ================= -->
<script>
document.getElementById("search").addEventListener("keyup", function () {
    let keyword = this.value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "gallery_search.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        document.getElementById("tableGalleryBody").innerHTML = this.responseText;
    };

    xhr.send("keyword=" + encodeURIComponent(keyword));
});
</script>
