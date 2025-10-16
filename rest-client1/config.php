<?php
// config.php

// Fungsi custom untuk melakukan HTTP GET request (Menggunakan cURL)
if (!function_exists('http_request_get')) {
    function http_request_get($url) {
        // Inisialisasi cURL
        $ch = curl_init(); 
        
        // Set URL target
        curl_setopt($ch, CURLOPT_URL, $url);
        
        // Kembalikan transfer sebagai string (bukan output langsung)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        
        // Eksekusi cURL dan simpan hasilnya
        $output = curl_exec($ch);
        
        // Tutup resource cURL
        curl_close($ch);      
        
        // Kembalikan data yang didapat
        return $output;
    }
}
?>