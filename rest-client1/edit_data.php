<?php
// Pastikan header JSON tidak dikirim karena output utama adalah HTML
header('Content-Type: text/html');

// Memuat file konfigurasi dan fungsi http_request_get()
require_once("config.php"); 

// Ambil parameter ID dar URL dengan pengecekan aman (Menghindari Warning Undefined array key "id")
$id = $_GET['id'] ?? null; 

// Jika ID kosong atau tidak ada
if (empty($id)) {
    echo "<p style='color:red;'>ERROR: ID pengurus harus disertakan di URL, contoh: edit_data.php?id=1</p>";
    exit;
}

// URL untuk memanggil API RESTful Anda
$url = "http://localhost/PPL-KHOTIM/rest-api/tampil_data.php?id=" . urlencode($id);

// Mengambil data JSON (Memanggil fungsi dari config.php)
$data_json = http_request_get($url);
$hasil_array = json_decode($data_json, true);

// -----------------------------------------------------------
// Pengecekan Data dan Error Handling
// -----------------------------------------------------------

// 1. Cek apakah ada error saat decoding JSON
if (json_last_error() !== JSON_ERROR_NONE || !is_array($hasil_array)) {
    echo "<p style='color:red;'>ERROR: Data yang diterima dari API tidak valid. Output mentah: " . htmlspecialchars($data_json) . "</p>";
    exit;
}

// 2. Ambil array data pengurus dari key 'pengurus'
$pengurus = $hasil_array['pengurus'] ?? null; 

// 3. Cek jika data pengurus adalah NULL (artinya ID tidak ditemukan di database atau API error)
if ($pengurus === null || !is_array($pengurus)) {
    // Ambil pesan error dari API jika ada
    $pesan_error = $hasil_array['message'] ?? "Data pengurus dengan ID " . htmlspecialchars($id) . " tidak ditemukan.";
    echo "<p style='color:red;'>ERROR: " . htmlspecialchars($pesan_error) . "</p>";
    exit;
}

// Jika sampai di sini, variabel $pengurus pasti berisi data
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Ubah Data Pengurus</title>
</head>
<body>
    <h1>Ubah Data Pengurus</h1>
 
    <form method="POST" action="ubah_data.php">
 
    <table>
        <tr>
            <td>ID</td>
            <td><input type="text" name="id" value="<?php echo htmlspecialchars($pengurus['id']); ?>" readonly></td>
        </tr>
        <tr>
            <td>NAMA</td>
            <td><input type="text" name="nama" value="<?php echo htmlspecialchars($pengurus['nama']); ?>"></td>
        </tr>
        <tr>
            <td>ALAMAT</td>
            <td><textarea name="alamat"><?php echo htmlspecialchars($pengurus['alamat']); ?></textarea></td>
        </tr>
        <tr>
            <td>GENDER</td>
            <td>
            <select name="gender">
                <option value="L" <?php echo ($pengurus['gender'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="P" <?php echo ($pengurus['gender'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
            </select>
            </td>
        </tr>
        <tr>
            <td>GAJI</td>
            <td><input type="number" name="gaji" value="<?php echo htmlspecialchars($pengurus['gaji']); ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" name="ubah">UBAH</button>
                <button type="reset">BATAL</button>
            </td>
        </tr>
    </table>
    
    </form>
 
</body>
</html>