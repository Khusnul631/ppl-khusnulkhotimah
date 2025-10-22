<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');
require_once('config/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_hencode(['response'=>405, 'pesan'=>'Method not allowed']);
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
if ($id <= 0) {
    echo json_encode(['response'=>400, 'pesan'=>'Parameter id tidak valid']);
    exit;
}

$query = "DELETE FROM pengurus WHERE id = $id";
$result = mysqli_query($con, $query);

if ($result) {
    echo json_encode(['response'=>200, 'pesan'=>'Data berhasil dihapus']);
} else {
    echo json_encode(['response'=>500, 'pesan'=>mysqli_error($con)]);
}
?>