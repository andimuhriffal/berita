<?php 
include 'koneksi.php';
if ($_GET['proses']=='insert') {
    if (isset($_POST['Proses'])){
        $kode_ruangan = $_POST['kode_ruangan'];
        $nama_ruangan = $_POST['nama_ruangan'];
        $gedung = $_POST['gedung'];
        $lantai = $_POST['lantai'];
        $jenis_ruangan = $_POST['jenis_ruangan'];
        $kapasitas = $_POST['kapasitas'];
        $keterangan = $_POST['keterangan'];

        
        $sql = mysqli_query($db, "INSERT INTO ruangan (kode_ruangan, nama_ruangan, gedung, lantai, jenis_ruangan, kapasitas, keterangan) VALUES ('$kode_ruangan', '$nama_ruangan','$gedung','$lantai','$jenis_ruangan','$kapasitas','$keterangan')");

        
        if ($sql){
            echo "<script>window.location='index.php?p=ruangan'</script>";
        } else {
            echo "Data gagal disimpan";
        }
    }
}

if ($_GET['proses']=='update') {
    if (isset($_POST['Proses'])) {
        // Mengambil data dari form
        $id = $_GET['id'];
        $kode_ruangan = $_POST['kode_ruangan'];
        $nama_ruangan = $_POST['nama_ruangan'];
        $gedung = $_POST['gedung'];
        $lantai = $_POST['lantai'];
        $jenis_ruangan = $_POST['jenis_ruangan'];
        $kapasitas = $_POST['kapasitas'];
        $keterangan = $_POST['keterangan'];
        

        // Query untuk mengupdate data prodi berdasarkan ID
        $sql = mysqli_query($db, "UPDATE ruangan SET 
            kode_ruangan = '$kode_ruangan',
            nama_ruangan = '$nama_ruangan',
            gedung = '$gedung',
            lantai = '$lantai',
            jenis_ruangan = '$jenis_ruangan',
            kapasitas = '$kapasitas',
            keterangan = '$keterangan'
            WHERE id = '$id'");

        // Jika berhasil update, redirect ke halaman index.php?p=prodi
        if ($sql) {
            echo "<script>window.location='index.php?p=ruangan'</script>";
        } else {
            echo "Gagal memperbarui data!";
        }
    }
}

if ($_GET['proses']=='delete') {
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    
        $query = "DELETE FROM ruangan WHERE id='$id'";
        $sql = mysqli_query($db, $query);
    
        
        if($sql){
            header("Location:index.php?p=ruangan");
        } else {
            echo "Gagal menghapus data!";
        }
    } 
}
?>