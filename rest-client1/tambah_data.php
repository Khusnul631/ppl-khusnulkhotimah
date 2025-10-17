<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = [
        'nama' => $_POST['nama'],
        'alamat' => $_POST['alamat'],
        'gender' => $_POST['gender'],
        'gaji' => $_POST['gaji']
    ];
    $ch = curl_init(API_BASE . '/tambah_data.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $res = curl_exec($ch);
    if (curl_errno($ch)) {
        $msg = 'Curl error: ' . curl_error($ch);
    } else {
        $resp = json_decode($res, true);
        if (isset($resp['response']) && $resp['response']==201) {
            header('Location: tampil_data.php');
            exit;
        } else {
            $msg = $resp['pesan'] ?? 'Gagal';
        }
    }
    curl_close($ch);
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><title>Tambah Data</title></head>
<body>
<h2>Tambah Pengurus</h2>
<?php if(!empty($msg)) echo '<p style="color:red">'.$msg.'</p>'; ?>
<form method="POST" action="">
<label>Nama:<br><input type="text" name="nama" required></label><br>
<label>Alamat:<br><textarea name="alamat"></textarea></label><br>
<label>Gender:<br>
<select name="gender" required><option value="">--Pilih--</option><option value="L">L</option><option value="P">P</option></select></label><br>
<label>Gaji:<br><input type="number" name="gaji" required></label><br>
<button type="submit">Simpan</button>
</form>
<p><a href="tampil_data.php">Kembali</a></p>
</body>
</html>