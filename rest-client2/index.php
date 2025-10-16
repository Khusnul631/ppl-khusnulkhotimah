<?php
// load config.php
// Pastikan file ini berisi fungsi http_request_get()
include("config/config.php");

// untuk api_key newsapi.org
$api_key="d45f6f1cf4e0405784b52bae7bbb8767";

// url api untuk ambil berita headline di US
$url="https://newsapi.org/v2/top-headlines?country=us&apiKey=".$api_key;

// menyimpan hasil dalam variabel
$data=http_request_get($url);

// konversi data json ke array
$hasil=json_decode($data,true);

// Tentukan URL untuk gambar placeholder (pastikan Anda punya 'images/placeholder.jpg')
$placeholder_image = 'https://via.placeholder.com/400x200?text=No+Image'; // Menggunakan placeholder online untuk demo

?>
<!DOCTYPE html>
<html>
<head>
    <title>REST Client News - Tampilan Baru</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang ringan */
        }
        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }
        .news-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border: none;
            border-radius: 10px;
        }
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .footer {
            background-color: #343a40; /* Warna gelap untuk footer */
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#home">NewsAPI Client</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#news">News <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<header id="home" class="jumbotron jumbotron-fluid bg-primary text-white text-center mb-0" style="padding-top: 100px;">
  <div class="container">
    <h1 class="display-4">Top Headline News</h1>
    <p class="lead">Berita terkini dari Amerika Serikat, didukung oleh NewsAPI.</p>
  </div>
</header>

<div id="news" class="container py-5">
    <h2 class="mb-4 text-center text-dark">Berita Utama</h2>
    <div class="row">

<?php 
if (isset($hasil['articles']) && is_array($hasil['articles'])) {
    foreach ($hasil['articles'] as $row) { 
        // Logika penanganan gambar (menggunakan placeholder jika kosong)
        $image_url = !empty($row['urlToImage']) ? $row['urlToImage'] : $placeholder_image;
        $author_name = !empty($row['author']) ? $row['author'] : 'Editor';
?>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card news-card h-100 shadow-sm">
                <img src="<?php echo $image_url; ?>" class="card-img-top" alt="Gambar Berita" style="height: 200px; object-fit: cover;" 
                     onerror="this.onerror=null; this.src='<?php echo $placeholder_image; ?>';">
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-dark font-weight-bold"><?php echo $row['title']; ?></h5>
                    <p class="card-subtitle mb-2 text-muted small">
                        Oleh **<?php echo $author_name; ?>** pada 
                        <?php echo date('d M Y', strtotime($row['publishedAt'])); ?>
                    </p>
                    <p class="card-text flex-grow-1 text-secondary">
                        <?php 
                            $description = $row['description'] ?? $row['content'] ?? '';
                            echo (strlen($description) > 120) ? substr($description, 0, 120) . '...' : $description;
                        ?>
                    </p>
                    <div class="mt-auto pt-3">
                        <a href="<?php echo $row['url']; ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>

<?php 
    } // end foreach
} else {
    echo '<div class="col-12"><div class="alert alert-danger text-center" role="alert">Gagal memuat berita. Mohon cek API Key atau file config.php.</div></div>';
}
?>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div id="about" class="col-md-6 mb-3">
                <h4>About Us</h4>
                <p class="text-secondary">Aplikasi ini adalah REST Client sederhana yang mengambil data *headline* berita secara *real-time* menggunakan NewsAPI dan cURL di PHP.</p>
            </div>
            <div id="contact" class="col-md-6 mb-3">
                <h4>Contact</h4>
                <p class="text-secondary">
                    Email: developer@example.com<br>
                    Alamat: Jakarta, Indonesia<br>
                    Source API: NewsAPI.org
                </p>
            </div>
        </div>
        <hr class="bg-secondary">
        <p class="text-center text-secondary small mb-0">&copy; 2025 REST Client Demo.</p>
    </div>
</footer>

<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>