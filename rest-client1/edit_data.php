<?php
require_once('config.php');

if (!isset($_GET['id'])) {
    echo 'ID tidak ditemukan';
    exit;
}
$id = intval($_GET['id']);
$url = API_BASE . '/tampil_detail.php?id=' . $id;
$res = @file_get_contents($url);
$data = json_decode($res, true);
if (!isset($data['data'])) {
    echo 'Data tidak ditemukan';
    exit;
}
$row = $data['data'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = [
        'id' => $id,
        'nama' => $_POST['nama'],
        'alamat' => $_POST['alamat'],
        'gender' => $_POST['gender'],
        'gaji' => $_POST['gaji']
    ];
    $ch = curl_init(API_BASE . '/ubah_data.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $resp = curl_exec($ch);
    if (curl_errno($ch)) {
        $msg = 'Curl error: '.curl_error($ch);
    } else {
        $jr = json_decode($resp, true);
        if (isset($jr['response']) && $jr['response']==200) {
            header('Location: tampil_data.php');
            exit;
        } else {
            $msg = $jr['pesan'] ?? 'Gagal update';
        }
    }
    curl_close($ch);
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><title>Edit Data</title></head>
<body>
<h2>Edit Pengurus</h2>
<?php if(!empty($msg)) echo '<p style="color:red">'.$msg.'</p>'; ?>
<form method="POST" action="">
<label>Nama:<br><input type="text" name="nama" required value="<?= htmlspecialchars($row['nama']) ?>"></label><br>
<label>Alamat:<br><textarea name="alamat"><?= htmlspecialchars($row['alamat']) ?></textarea></label><br>
<label>Gender:<br>
<select name="gender" required>
<option value="L" <?= ($row['gender']=='L')?'selected':'' ?>>L</option>
<option value="P" <?= ($row['gender']=='P')?'selected':'' ?>>P</option>
</select></label><br>
<label>Gaji:<br><input type="number" name="gaji" required value="<?= htmlspecialchars($row['gaji']) ?>"></label><br>
<button type="submit">Simpan Perubahan</button>
</form>
<p><a href="tampil_data.php">Kembali</a></p>
</body>
</html>