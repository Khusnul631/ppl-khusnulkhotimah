<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');
require_once('config/koneksi.php');

$query = "SELECT * FROM pengurus ORDER BY id ASC";
$result = mysqli_query($con, $query);

$data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode(['response'=>200, 'data'=>$data]);
} else {
    echo json_encode(['response'=>500, 'pesan'=>mysqli_error($con)]);
}
?>