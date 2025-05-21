<?php  
session_start();
include '../koneksi.php';

// Ambil data dari form
$nama_user = $_POST['nama_user'];
$username = $_POST['username'];
$password = $_POST['password'];

// Tentukan id_level sebagai 5 (Pelanggan)
$id_level = 5;

// Hash password sebelum disimpan (untuk keamanan)
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Query untuk input data
$query = "INSERT INTO tb_user (username, password, nama_user, id_level) 
          VALUES ('$username', '$password_hash', '$nama_user', '$id_level')";

// Jalankan query
$sql = mysqli_query($kon, $query);

// Cek hasil
if ($sql) {
    $_SESSION['pesan'] = '
        <div class="alert alert-success mb-2 alert-dismissible text-small" role="alert">
            <b>Berhasil!</b> Registrasi akun berhasil. Anda sekarang terdaftar sebagai Pelanggan.
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
    header('location: ../index.php'); // Arahkan ke halaman index setelah registrasi berhasil
} else {
    $_SESSION['pesan'] = '
        <div class="alert alert-danger mb-2 alert-dismissible text-small" role="alert">
            <b>Gagal!</b> Registrasi akun gagal. Silakan coba lagi.
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
    header('location: ../auth/register.php'); // Kembali ke halaman registrasi jika gagal
}
?>
