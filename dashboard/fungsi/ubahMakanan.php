<?php  
session_start();
error_reporting(0);
include "../../koneksi.php";

// Ambil data dari form
$id = $_GET['id_masakan'];
$kategori = $_POST['kategori_masakan'];
$nama = $_POST['nama_masakan'];
$harga = $_POST['harga_masakan'];
$status = $_POST['status_masakan'];

// Cek apakah ingin mengubah foto atau tidak
if (isset($_POST['ubah_foto'])) {
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $fotobaru = date('dmYHis') . $foto;
    $path = "../assets/image/makanan/$fotobaru";

    // Ambil data foto lama dari database
    $query = "SELECT * FROM tb_masakan WHERE id_masakan='$id'";
    $sql = mysqli_query($kon, $query);
    $data = mysqli_fetch_assoc($sql);

    if (move_uploaded_file($tmp, $path)) {
        // Hapus foto lama jika ada
        if (!empty($data['foto']) && file_exists("../assets/image/makanan/" . $data['foto'])) {
            unlink("../assets/image/makanan/" . $data['foto']);
        }

        // Update database dengan foto baru
        $query = "UPDATE tb_masakan SET kategori_masakan='$kategori', nama_masakan='$nama', harga_masakan='$harga', foto='$fotobaru', status_masakan='$status' WHERE id_masakan='$id'";
        $sql = mysqli_query($kon, $query);

        $pesan = $sql ? "Berhasil! Data berhasil diubah" : "Gagal! Data gagal diubah";
    } else {
        $pesan = "Gagal! Foto gagal diunggah";
    }
} else {
    // Jika tidak mengubah foto
    $query = "UPDATE tb_masakan SET kategori_masakan='$kategori', nama_masakan='$nama', harga_masakan='$harga', status_masakan='$status' WHERE id_masakan='$id'";
    $sql = mysqli_query($kon, $query);
    $pesan = $sql ? "Berhasil! Data berhasil diubah" : "Gagal! Data gagal diubah";
}

// Set pesan notifikasi
$_SESSION['pesan'] = '
    <div class="alert alert-' . ($sql ? 'success' : 'danger') . ' mb-2 alert-dismissible text-small" role="alert">
        <b>' . $pesan . '</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
';

// Redirect ke halaman yang sesuai
header('location:../index.php?' . strtolower($kategori));
exit();
?>
