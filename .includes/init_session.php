<?php
session_start();

$name = $_SESSION["name"];
$role = $_SESSION["role"];
// ambil notifikasi jika ada, kemudian hapus dari sesi
$notificatian = $_SESSION['ntification'] ?? null;
if ($notificatian){
    unset($_SESSION['notification']);
}
?>