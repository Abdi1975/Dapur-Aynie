<?php  
session_start();
include '../../koneksi.php';

// Ambil data dari form
$nama_user = mysqli_real_escape_string($kon, $_POST['nama_user']);
$username = mysqli_real_escape_string($kon, $_POST['username']);
$password = mysqli_real_escape_string($kon, $_POST['password']);
$id_level = mysqli_real_escape_string($kon, $_POST['id_level']);

// Query input data
$query = "INSERT INTO tb_user (username, password, nama_user, id_level) 
          VALUES ('$username', '$password', '$nama_user', '$id_level')";

$sql = mysqli_query($kon, $query);

// Cek jika query berhasil
if ($sql) {
    $_SESSION['pesan'] = '
    <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
        <b>Berhasil!</b> Registrasi User berhasil
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('location:../index.php?user');
} else {
    $_SESSION['pesan'] = '
    <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
        <b>Gagal!</b> Registrasi User gagal. Error: ' . mysqli_error($kon) . '
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('location:../index.php?user');
}

// Tutup koneksi database
mysqli_close($kon);
?>
