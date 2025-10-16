<?php
require_once("config/koneksi.php");

$username=$_POST['username'];
$password=md5($_POST['password']);

$query="SELECT id_admin, username FROM admin WHERE username='$username' AND password='$password'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) > 0) {
    $respon=array( //digunakan untuk pesan
		'response' => 200,
        'id_admin' => $row['id_admin'],
        'username' => $row['username'],
		'isLogin' => true
    );
    http_response_code(200);
    echo json_encode($respon);
} else {
    $respon=array( //digunakan untuk pesan
		  'response' => 401,
		  'isLogin' => false
    );
    http_response_code(401);
    echo json_encode($respon);
}
?>