<?php

// konfigurasi koneksi database
$host = "localhost"; // nama host server database
$username = "root"; // username untuk akses database
$passsword = ""; // password untuk akses database
$database = "idekreatif"; // nama database yang digunakan

// membuat koneksi ke databse menggunakan Mysql
$$conn = mysqli_connect($host,$username,$password,$database);

// mengecek apakah koneksi berhasil
if ($conn_connect_error) {
    // menampilkan pesan error jika koneksi gagal
    die("database gagal terkoneksi: " . $conn->connect_error);
}

// jika koneksi berhasil, script akan harus berjalan tanpa pesan error
?>