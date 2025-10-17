<?php
require_once('config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $ch = curl_init(API_BASE . '/hapus_data.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ['id' => $id]);
    $res = curl_exec($ch);
    curl_close($ch);
}
header('Location: tampil_data.php');
exit;
?>