<h2>Data Mahasiswa</h2>
<table id="example" class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Email</th>
            <th>Prodi ID</th>
            <th>No Telpon</th>
            <th>Alamat</th>
        </tr>
        
    </thead>

    <tbody>
        <?php
           include 'admin/koneksi.php';
           $sql=mysqli_query($db, "SELECT * FROM mahasiswa");
           $no=1;
           while ($data_mhs=mysqli_fetch_array($sql)){

        ?>
        <tr>
            <td><?=$no ?></td>
            <td><?=$data_mhs['nim']?></td>
            <td><?=$data_mhs['nama_mhs']?></td>
            <td><?=$data_mhs['email']?></td>
            <td><?=$data_mhs['prodi_id']?></td>
            <td><?=$data_mhs['nohp']?></td>
            <td><?=$data_mhs['alamat']?></td>
        </tr>
        <?php
            $no++;
             }
        ?>
    </tbody>

</table>