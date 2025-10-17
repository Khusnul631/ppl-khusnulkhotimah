<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');
require_once('config/koneksi.php');

if (!isset($_GET['id'])) {
    echo json_encode(['response'=>400, 'pesan'=>'Parameter id diperlukan']);
    exit;
}

$id = intval($_GET['id']);
$query = "SELECT * FROM pengurus WHERE id = $id LIMIT 1";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode(['response'=>200, 'data'=>$row]);
} else {
    echo json_encode(['response'=>404, 'pesan'=>'Data tidak ditemukan']);
}
?>