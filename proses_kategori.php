<?php

// menghubungkan ke file konfigurasi database
include("config.php");

// memulai sesi untuk menyimpan notifikasi
session_start();

// proses penambahan kategori baru
if (isset($_POST['simpan'])) {
    // mengambil data nama kategori ke dalam database
    $query = "INSERT INTO categories (category_name) VALUES
    ('category_name')";
}
?>