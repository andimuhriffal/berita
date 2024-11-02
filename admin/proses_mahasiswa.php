<?php 
include 'koneksi.php';
if ($_GET['proses']=='insert') {
    if (isset($_POST['Proses'])){
        
        $tgllahir=$_POST['tahun'].'-'.$_POST['bulan'].'-'.$_POST['tgl_lahir'];
        $hobi=implode(",",$_POST['hobi']);
        $sql=mysqli_query($db,"INSERT INTO mahasiswa(nim,nama_mhs,tgl_lahir,jenis_kelamin,email,prodi_id,nohp,hobi,alamat) VALUE ('$_POST[nim]','$_POST[nama_mhs]','$tgl_lahir','$_POST[jenis_kelamin]','$_POST[email]','$_POST[prodi_id]','$_POST[nohp]','$hobi','$_POST[alamat]')");

        if ($sql){
            echo "<script>window.location='index.php?p=mhs'</script>";
           
        }
    }
}

if ($_GET['proses']=='update') {
    if (isset($_POST['Proses'])){
        $tgl_lahir=$_POST['tahun'].'-'.$_POST['bulan'].'-'.$_POST['tgllahir'];
        $hobi=implode(",",$_POST['hobi']);
        $sql=mysqli_query($db,"UPDATE mahasiswa SET
        nama_mhs = '$_POST[nama_mhs]',
        tgl_lahir = '$tgl_lahir',
        jenis_kelamin = '$_POST[jenis_kelamin]',
        email = '$_POST[email]',
        prodi_id = '$_POST[prodi_id]',
        nohp = '$_POST[nohp]',
        hobi = '$hobies',
        alamat = '$_POST[alamat]' WHERE nim='$_POST[nim]'");

        if ($sql){
            echo "<script>window.location='index.php?p=mhs'</script>";
           
        }
    }
}

if ($_GET['proses']=='delete') {
    $hapus = mysqli_query($db,"DELETE FROM mahasiswa WHERE nim='$_GET[nim]'");

    if($hapus){
        header("Location: index.php?p=mhs");
    } else{
        echo "Gagal menghapus data!";
    }
}
?>