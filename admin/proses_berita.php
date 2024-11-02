<?php
session_start();
$target_dir = "uploads/";
$nama_file = rand() . '-' . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $nama_file;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if ($_GET['proses'] == 'insert') {
    include 'koneksi.php';

    // Check if image file is an actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (minimum 1KB, maximum 100MB)
    if ($_FILES["fileToUpload"]["size"] < 1024) {
        echo "Sorry, your file is too small. Minimum size is 1KB.";
        $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 100 * 1024 * 1024) { // 100MB
        echo "Sorry, your file is too large. Maximum size is 100MB.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // If everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert into database
    $sql = mysqli_query($db, "INSERT INTO berita (user_id, kategori_id, judul, file_upload, isi_berita) VALUES ('$_SESSION[user_id]','$_POST[kategori_id]','$_POST[judul]','$nama_file','$_POST[isi_berita]')");

    if ($sql) {
        echo "<script>window.location='index.php?p=berita'</script>";
    }
}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['Proses'])) {
        // Mengambil data dari form
        $id = $_POST['id']; // Pastikan ID diambil dari form
        $nama_berita = $_POST['nama_berita'];
        $user_id = $_POST['user_id'];

        // Query untuk update data berdasarkan ID
        $sql = mysqli_query($db, "UPDATE kategori SET 
            nama_berita = '$nama_berita',
            user_id = '$user_id'
            WHERE id = '$id'");

        // Redirect jika berhasil update
        if ($sql) {
            echo "<script>window.location='index.php?p=berita'</script>";
        } else {
            echo "Gagal memperbarui data!";
        }
    }
}

if ($_GET['proses']=='delete') {
    include("koneksi.php");
    unlink($target_dir.$_GET['img']);
    $hapus = mysqli_query($db, "DELETE FROM berita WHERE id='$_GET[id]'");
    if ($hapus) {
        header("Location:index.php?p=berita");
    }
}
