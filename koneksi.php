<?php  
$host     = "192.168.1.10"; // IP Server Database
$user     = "abdul";    // atau root
$password = "123";   // sesuaikan
$database = "restodapuraynie";

$kon = mysqli_connect($host, $user, $password, $database);

if (!$kon) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
