<?php
require_once("../config.php");
// mulai session
session_start();

if($_SERVERr["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, name, password)
    VALUES ('$username','$name','$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        //simpan notifikasi ke dalam session
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'registrasi berhasil'
        ];
        } else {

        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => ' gagal registrasi: ' . mysqli_error($conn)
        ];
    }

    header('location: login.php');
    exit();
  }

  $conn->close();
  ?>