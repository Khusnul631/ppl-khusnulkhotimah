<?php
include("config/config.php"); // pastikan berisi fungsi http_request_get()

$api_key = "fb93ff7b01ac40d0a27425c488071ef3";
$base_url = "https://newsapi.org/v2/top-headlines";

// ---------- Fungsi Testing ----------
function test_api($name, $url, $expected_status) {
    $data = http_request_get($url);
    $result = json_decode($data, true);

    // Logika hasil
    if (isset($result['status']) && $result['status'] == $expected_status) {
        $status = "✅ PASS";
    } else {
        $status = "❌ FAIL";
    }

    // Tampilkan hasil
    echo "<tr>
            <td>{$name}</td>
            <td>{$url}</td>
            <td>{$expected_status}</td>
            <td>" . ($result['status'] ?? 'No Response') . "</td>
            <td>{$status}</td>
          </tr>";
}

// ---------- TEST CASES ----------
$tests = [
    [
        "name" => "Valid API Request (country=us)",
        "url" => "{$base_url}?country=us&apiKey={$api_key}",
        "expected" => "ok"
    ],
    [
        "name" => "Invalid API Key",
        "url" => "{$base_url}?country=us&apiKey=INVALID_KEY",
        "expected" => "error"
    ],
    [
        "name" => "Invalid Country Parameter",
        "url" => "{$base_url}?country=zzz&apiKey={$api_key}",
        "expected" => "error"
    ],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>System Testing - NewsAPI Client</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
body {
    background-color: #f7f9fc;
    font-family: Arial, sans-serif;
    margin: 40px;
}
h1 {
    color: #2b6cb0;
    text-align: center;
    margin-bottom: 20px;
}
table {
    background: white;
    border-radius: 10px;
    overflow: hidden;
}
thead {
    background-color: #a8d5e2;
    color: white;
}
td, th {
    padding: 10px;
    text-align: left;
}
</style>
</head>
<body>
<h1>🧩 Sistem Testing API NewsAPI.org</h1>
<table class="table table-bordered shadow-sm">
<thead>
<tr>
    <th>Nama Test</th>
    <th>URL</th>
    <th>Ekspektasi</th>
    <th>Respons API</th>
    <th>Hasil</th>
</tr>
</thead>
<tbody>
<?php
foreach ($tests as $test) {
    test_api($test["name"], $test["url"], $test["expected"]);
}
?>
</tbody>
</table>
</body>
</html>
