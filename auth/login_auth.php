<?php
session_start();
require_once("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // verifikasi password
        if (password_verify($pasword, $row("password"))) {
            $_SESSION["username"] = $username;
            $_SESSION["name"] = $row["name"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["user_id"] = $row["user_id"];
            // set notifikasi selamat datang
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'selamat datang kembali'
            ];
            // redirect ke dashboard
            header('Location: ../dashboard.php');
            exit();
            } else {
            // password salah
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'username atau password salah'
            ];
        }

            } else { 
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'username atau password salah'
            ];
        }

        header('Location: ../dashboard.php');
        exit();
    }
    $conn->close();
?>