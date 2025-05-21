<?php
// Set timezone untuk Indonesia
date_default_timezone_set('Asia/Jakarta');

// Menetapkan kredensial untuk koneksi database
$host = "localhost";  // Ganti dengan alamat IP atau hostname server database jika diperlukan
$username = "root";       // Ganti dengan username MySQL
$password = "";       // Ganti dengan password MySQL
$dbname = "restodapuraynie"; // Nama database yang ingin digunakan

// Membuat koneksi ke database
$kon = mysqli_connect($host, $username, $password, $dbname, 3306);