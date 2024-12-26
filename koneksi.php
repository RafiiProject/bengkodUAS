<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_sks";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
