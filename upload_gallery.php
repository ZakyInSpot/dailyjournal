<?php
date_default_timezone_set('Asia/Jakarta');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "koneksi.php";

/* ================= FUNGSI UPLOAD ================= */
function upload_foto($File){    
    $hasil = array();

    $FileName = $File['name'];
    $TmpLocation = $File['tmp_name'];
    $FileSize = $File['size'];

    $FileExt = strtolower(pathinfo($FileName, PATHINFO_EXTENSION));
    $Allowed = array('jpg', 'jpeg', 'png', 'gif');  

    if ($FileSize > 500000) {
        return ['status'=>false,'message'=>'Ukuran file maksimal 500KB'];
    }

    if (!in_array($FileExt, $Allowed)) {
        return ['status'=>false,'message'=>'Format file tidak diizinkan'];
    }

    $NewName = date("YmdHis") . '_' . rand(100,999) . '.' . $FileExt;
    $UploadDir = "gallery/";
    $UploadDestination = $UploadDir . $NewName;

    if (move_uploaded_file($TmpLocation, $UploadDestination)) {
        return ['status'=>true,'message'=>$UploadDestination];
    }

    return ['status'=>false,'message'=>'Gagal upload'];
}

/* ================= SIMPAN ================= */
if (isset($_POST['simpan'])) {

    $deskripsi = $_POST['deskripsi'];
    $tanggal   = date('Y-m-d H:i:s');
    $username  = $_SESSION['username'];

    $upload = upload_foto($_FILES['gambar']);

    if ($upload['status']) {
        $stmt = $conn->prepare(
            "INSERT INTO gallery (deskripsi, gambar, tanggal, username)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $deskripsi, $upload['message'], $tanggal, $username);
        $stmt->execute();
    }
}

/* ================= HAPUS (FIXED) ================= */
if (isset($_POST['hapus'])) {

    $id = intval($_POST['id']);

    $ambil = $conn->query("SELECT gambar FROM gallery WHERE id=$id");
    if ($ambil && $ambil->num_rows) {
        $data = $ambil->fetch_assoc();

        if (!empty($data['gambar']) && file_exists($data['gambar'])) {
            unlink($data['gambar']);
        }
    }

    $conn->query("DELETE FROM gallery WHERE id=$id");

    // ⛔ JANGAN echo script / redirect
}

/* ================= EDIT (DITAMBAHKAN) ================= */
if (isset($_POST['edit'])) {

    $id        = intval($_POST['id']);
    $deskripsi = $_POST['deskripsi'];

    // cek apakah user upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {

        // ambil gambar lama
        $ambil = $conn->query("SELECT gambar FROM gallery WHERE id=$id");
        if ($ambil && $ambil->num_rows) {
            $data = $ambil->fetch_assoc();
        }

        // upload gambar baru
        $upload = upload_foto($_FILES['gambar']);

        if ($upload['status']) {

            // hapus gambar lama
            if (!empty($data['gambar']) && file_exists($data['gambar'])) {
                unlink($data['gambar']);
            }

            // update deskripsi + gambar
            $stmt = $conn->prepare(
                "UPDATE gallery SET deskripsi=?, gambar=? WHERE id=?"
            );
            $stmt->bind_param("ssi", $deskripsi, $upload['message'], $id);
            $stmt->execute();
        }

    } else {
        // update deskripsi saja
        $stmt = $conn->prepare(
            "UPDATE gallery SET deskripsi=? WHERE id=?"
        );
        $stmt->bind_param("si", $deskripsi, $id);
        $stmt->execute();
    }

    // ⛔ JANGAN redirect / echo
}
