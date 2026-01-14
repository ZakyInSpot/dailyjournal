<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "koneksi.php";

/* ================= USER LOGIN ================= */
$username = $_SESSION['username'];

$user = $conn->query(
    "SELECT * FROM user WHERE username='$username'"
)->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data" class="col-md-6">

    <!-- USERNAME (READONLY) -->
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text"
               class="form-control"
               value="<?= htmlspecialchars($user['username']) ?>"
               readonly>
    </div>

    <!-- PASSWORD -->
    <div class="mb-3">
        <label class="form-label">Ganti Password</label>
        <input type="password"
               name="password"
               class="form-control"
               placeholder="Kosongkan jika tidak ingin mengganti password">
    </div>

    <!-- FOTO -->
    <div class="mb-3">
        <label class="form-label">Ganti Foto Profil</label>
        <input type="file"
               name="foto"
               class="form-control"
               accept="image/*">
    </div>

    <!-- FOTO SAAT INI -->
    <div class="mb-3">
        <label class="form-label">Foto Profil Saat Ini</label><br>
        <?php if (!empty($user['foto'])): ?>
            <img src="<?= $user['foto']; ?>"
                 width="120"
                 height="120"
                 class="rounded-circle border"
                 style="object-fit: cover;">
        <?php else: ?>
            <span class="text-muted">Belum ada foto</span>
        <?php endif; ?>
    </div>

    <button type="submit" name="simpan" class="btn btn-primary">
        Simpan
    </button>
</form>

<?php
/* ================= UPDATE PROFILE ================= */
if (isset($_POST['simpan'])) {

    /* ===== UPDATE PASSWORD ===== */
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $conn->query(
            "UPDATE user SET password='$password'
             WHERE username='$username'"
        );
    }

    /* ===== UPDATE FOTO ===== */
    if (!empty($_FILES['foto']['name'])) {

        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ext, $allowed)) {

            // hapus foto lama (jika ada)
            if (!empty($user['foto']) && file_exists($user['foto'])) {
                unlink($user['foto']);
            }

            $nama_foto = "profile/" . time() . "_" . rand(100,999) . "." . $ext;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $nama_foto)) {

                $conn->query(
                    "UPDATE user SET foto='$nama_foto'
                     WHERE username='$username'"
                );

                // ✅ update session agar dashboard langsung berubah
                $_SESSION['foto'] = $nama_foto;
            }
        }
    }

    echo "<script>
            alert('Profile berhasil diperbarui');
            location='admin.php?page=profile';
          </script>";
}
?>
