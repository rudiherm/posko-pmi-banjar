<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lapsit"; 

// Membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    // Jika koneksi gagal, arahkan ke 500.php
    header("Location: 500.php");
    exit();
}
?>