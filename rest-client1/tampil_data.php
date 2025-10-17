<?php
require_once('config.php');

$url = API_BASE . '/tampil_data.php';
$response = @file_get_contents($url);
$data = json_decode($response, true);
$rows = [];
if (isset($data['data'])) $rows = $data['data'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Data Pengurus</title>
<style>
body{font-family:Arial; padding:20px}
table{width:100%; border-collapse:collapse}
th,td{padding:8px; border:1px solid #ddd; text-align:left}
a.button{display:inline-block; padding:6px 10px; background:#007bff; color:#fff; text-decoration:none; border-radius:4px}
a.del{background:#dc3545}
.form-inline{display:flex; gap:8px; align-items:center}
</style>
</head>
<body>
<h2>Data Pengurus</h2>
<p><a class="button" href="tambah_data.php">Tambah Data</a></p>
<table>
<thead><tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Gender</th><th>Gaji</th><th>Aksi</th></tr></thead>
<tbody>
<?php foreach($rows as $r): ?>
<tr>
<td><?= htmlspecialchars($r['id']) ?></td>
<td><?= htmlspecialchars($r['nama']) ?></td>
<td><?= htmlspecialchars($r['alamat']) ?></td>
<td><?= htmlspecialchars($r['gender']) ?></td>
<td><?= htmlspecialchars($r['gaji']) ?></td>
<td>
    <a class="button" href="edit_data.php?id=<?= $r['id'] ?>">Edit</a>
    <form class="form-inline" method="POST" action="hapus_data.php" style="display:inline-block">
        <input type="hidden" name="id" value="<?= $r['id'] ?>">
        <button style="background:#dc3545;color:#fff;border:none;padding:6px 8px;border-radius:4px;cursor:pointer" type="submit">Hapus</button>
    </form>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</body>
</html>