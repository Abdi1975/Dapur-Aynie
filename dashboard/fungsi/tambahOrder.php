<?php
session_start();
require '../../koneksi.php';

$meja = htmlspecialchars($_POST['meja']);
$id_order = htmlspecialchars($_POST['id_order']);
$keterangan = htmlspecialchars($_POST['keterangan']);
$user_id = $_SESSION['id_user'];
$tanggal = time();
$tanggal2 = date('d-m-Y');

// Jika tidak memilih meja atau memilih meja yang salah
if ($meja === "" || ($meja !== "take-away" && intval($meja) < 0)) {
    $_SESSION['pesan'] = '
        <div class="alert alert-warning mb-2 alert-dismissible text-small " role="alert">
            <b>Maaf!</b> Meja belum dipilih
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
    header('location:../index.php');
    exit;
}

// Jika meja yang dipilih adalah take-away
if ($meja === "take-away") {
    // Tidak perlu mengubah status meja, biarkan status meja tetap 0
} else {
    // Update status meja jika meja dipilih dan bukan take-away
    mysqli_query($kon, "UPDATE tb_meja SET status = 1 WHERE meja_id = '$meja'");
}

// Update status detail order
mysqli_query($kon, "UPDATE tb_detail_order SET status_dorder = 1 WHERE id_order = '$id_order'");

// Insert pesanan ke tb_order
$queryTambah = "INSERT INTO tb_order 
(id_order, meja_order, tanggal_order, aTanggal_order, id_user, keterangan_order, status_order) 
VALUES 
('$id_order', '$meja', '$tanggal', '$tanggal2', '$user_id', '$keterangan', 'diproses')";

$query = mysqli_query($kon, $queryTambah);

// Cek hasil
if ($query) {
    $_SESSION['pesan'] = '
        <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Yoi!</b> Pesanan sedang diproses, mohon tunggu sampai masakan datang
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
} else {
    $_SESSION['pesan'] = '
        <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
            <b>Maaf!</b> Pesanan gagal diproses. Error: ' . mysqli_error($kon) . '
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
}
header('location:../index.php');
?>
