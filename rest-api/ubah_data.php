<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');
require_once('config/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['response'=>405, 'pesan'=>'Method not allowed']);
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$nama = isset($_POST['nama']) ? mysqli_real_escape_string($con, $_POST['nama']) : '';
$alamat = isset($_POST['alamat']) ? mysqli_real_escape_string($con, $_POST['alamat']) : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$gaji = isset($_POST['gaji']) ? intval($_POST['gaji']) : 0;

if ($id <= 0 || $nama === '' || ($gender !== 'P' && $gender !== 'L')) {
    echo json_encode(['response'=>400, 'pesan'=>'Data tidak lengkap atau tidak valid']);
    exit;
}

$query = "UPDATE pengurus SET nama='$nama', alamat='$alamat', gender='$gender', gaji=$gaji WHERE id = $id";
$result = mysqli_query($con, $query);

if ($result) {
    echo json_encode(['response'=>200, 'pesan'=>'Data berhasil diubah']);
} else {
    echo json_encode(['response'=>500, 'pesan'=>mysqli_error($con)]);
}
?>