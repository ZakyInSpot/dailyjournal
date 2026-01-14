<?php
// memulai session
session_start();

// menyertakan code dari file koneksi
include "koneksi.php";

// check jika sudah login
if (isset($_SESSION['username'])) {
    header("location:admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | My Daily Journal - Kuronaku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="img/logo.png" />
</head>

<body class="bg-danger-subtle">

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card border-0 shadow rounded-5">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="bi bi-person-circle h1 display-4"></i>
                        <p>Kuronaku</p>
                        <hr />
                    </div>

                    <form action="" method="post" id="loginForm">
                        <input type="text" name="user" id="user"
                               class="form-control my-4 py-2 rounded-4"
                               placeholder="Username">

                        <input type="password" name="pass" id="pass"
                               class="form-control my-4 py-2 rounded-4"
                               placeholder="Password">

                        <div class="text-center my-3 d-grid">
                            <button class="btn btn-danger rounded-4" name="login">
                                Login
                            </button>
                        </div>

                        <p id="errorMsg" class="text-danger text-center">
                            <?php
                            /* ================= PROSES LOGIN ================= */
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                $username = trim($_POST['user']);
                                $password_input = trim($_POST['pass']);

                                if ($username === "" || $password_input === "") {
                                    echo "Username dan Password wajib diisi!";
                                } else {

                                    // Ambil data user berdasarkan username
                                    $stmt = $conn->prepare(
                                        "SELECT * FROM user WHERE username=?"
                                    );
                                    $stmt->bind_param("s", $username);
                                    $stmt->execute();
                                    $hasil = $stmt->get_result();

                                    if ($hasil->num_rows === 1) {

                                        $row = $hasil->fetch_assoc();

                                        // 🔐 VERIFIKASI PASSWORD HASH
                                        if (password_verify($password_input, $row['password'])) {

                                            $_SESSION['username'] = $row['username'];
                                            $_SESSION['foto']     = $row['foto'];

                                            header("Location: admin.php");
                                            exit;

                                        } else {
                                            echo "Password salah!";
                                        }

                                    } else {
                                        echo "Username tidak ditemukan!";
                                    }
                                }
                            }
                            ?>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", function(event) {
    const user = document.getElementById("user").value.trim();
    const pass = document.getElementById("pass").value.trim();
    const errorMsg = document.getElementById("errorMsg");

    errorMsg.textContent = "";

    if (user === "") {
        errorMsg.textContent = "Username tidak boleh kosong!";
        event.preventDefault();
        return;
    }

    if (pass === "") {
        errorMsg.textContent = "Password tidak boleh kosong!";
        event.preventDefault();
        return;
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
