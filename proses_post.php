<?php
// menghubungkan file konfirgurasi database
include 'config.php';
// memulai sesi php
session_start();

// mendapatkan id pengguna dari sesi
$userId = $_SESSION["user_id"];

// menangani form untuk menambahkan postingan baru
if (isset($_POST['simpan'])) {
    // mendapatkan data dari form
    $postTitle = $_POST["post_title"];
    $content = $_POST["content"];
    $categoryId = $_POST["category_id"];

    // mengatur direktori penyimpanan file gambar
    $imageDir = "assets/img/uploads/";
    $imageName = $_FILES["image"]["name"];
    $imagePath = $imageDir . basename($imageName); // path lengkap gambar

    // memidahkan file gambar yang diunggah direktori tujuan
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        // jika unggahan berhasil, masukan
        // data postingan ke dalam database
        $query ="INSERT INTO posts (post_title, content, created_at, caterory_id, user_id, image_path) 
        VALUES ('$postTitle', '$content', NOW(), $categoryId, $userId, '$imagePath')";

        if ($conn->query($query) === TRUE) {
            // notifikasi berhasil jika postingan berhasil di tambahkan
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Post succesfully added.'
            ];
        } else {
            // notifikasi error jika postingan gagal menambahkan postingan
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Error adding post: ' . $conn->error
            ];
        }
        } else {
            // notifikasi error jika unggahan gambar gagal
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Failed to upload image.'
            ];
        }

        // arahkan ke halaman dashboard setelah selesai
        header('Location: dashboard.php');
        exit();
    }

    // proses penghapusan postingan
    if (isset($_POST['delete'])) {
        // mengambil id post dari parameter url
        $postID = $_POST['postID'];

        // query untuk menghapus post berdasarkan id
        $exec = mysqli_query($conn, "DELETE FROM posts WHERE id_post='$postID'");

        // menyimpan notifikasi keberhasilan atau kegagalan ke dalam sestion
        if ($exec) {
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Post successfully deleted.'
            ];
        } else {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Error deleting post: ' . mysqli_error($conn)
            ];
        }
    }

    // redirect kembali ke halaman dashboard
    header('Location: dashboard.php');
    exit();
?>

