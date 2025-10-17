<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // sesuaikan jika XAMPP kamu punya password untuk MySQL
$db   = 'pengurus';

$con = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    header('Content-Type: application/json');
    echo json_encode(['response'=>500, 'pesan'=>'Koneksi database gagal: '.mysqli_connect_error()]);
    exit;
}
?>