<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');
require_once('config/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['response'=>405, 'pesan'=>'Method not allowed']);
    exit;
}

$nama = isset($_POST['nama']) ? mysqli_real_escape_string($con, $_POST['nama']) : '';
$alamat = isset($_POST['alamat']) ? mysqli_real_escape_string($con, $_POST['alamat']) : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$gaji = isset($_POST['gaji']) ? intval($_POST['gaji']) : 0;

if ($nama === '' || ($gender !== 'P' && $gender !== 'L')) {
    echo json_encode(['response'=>400, 'pesan'=>'Data tidak lengkap atau format gender salah']);
    exit;
}

$query = "INSERT INTO pengurus (nama, alamat, gender, gaji) VALUES ('$nama', '$alamat', '$gender', $gaji)";
$result = mysqli_query($con, $query);

if ($result) {
    echo json_encode(['response'=>201, 'pesan'=>'Data berhasil ditambahkan', 'id' => mysqli_insert_id($con)]);
} else {
    echo json_encode(['response'=>500, 'pesan'=>mysqli_error($con)]);
}
?>