<?php 
function upload_foto($File){    
    $hasil = array();
    $message = '';

    // File properties
    $FileName = $File['name'];
    $TmpLocation = $File['tmp_name'];
    $FileSize = $File['size'];

    // Ambil ekstensi file
    $FileExt = strtolower(pathinfo($FileName, PATHINFO_EXTENSION));

    // Ekstensi yang diizinkan
    $Allowed = array('jpg', 'jpeg', 'png', 'gif');  

    // Validasi ukuran file (max 500KB)
    if ($FileSize > 500000) {
        $hasil['status'] = false;
        $hasil['message'] = 'Ukuran file maksimal 500KB';
        return $hasil;
    }

    // Validasi ekstensi
    if (!in_array($FileExt, $Allowed)) {
        $hasil['status'] = false;
        $hasil['message'] = 'Format file harus JPG, JPEG, PNG, atau GIF';
        return $hasil;
    }

    // Nama file baru
    $NewName = date("YmdHis") . '_' . rand(100,999) . '.' . $FileExt;

    // Folder upload (WAJIB ADA)
    $UploadDir = "uploads/";
    $UploadDestination = $UploadDir . $NewName;

    // Upload file
    if (move_uploaded_file($TmpLocation, $UploadDestination)) {
        $hasil['status']  = true;
        // ⬇️ SIMPAN PATH LENGKAP KE DATABASE
        $hasil['message'] = $UploadDestination;
    } else {
        $hasil['status']  = false;
        $hasil['message'] = 'Gagal mengupload gambar';
    }

    return $hasil;
}
?>
