<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boptstrap@4.6.1/dist/css/bootstrap.min.css">
    </head>
<title>
    EDIT DATA SISWA
</title>
<body>
    <nav class="navbar navbar-dark bg-dark">
           <span class="navbar-brand mb-0 h1">CRUD SEDERHANA</span>
        </div>
    </nav>
    <div class="container">
        <br>
        <h4><center>CRUD DATA SMKN 6 SURAKARTA</center></h4>
    <?php

        include "koneksi.php";

        // cek apakah ada kiriman form dari method post
        if (isset($_GET['id_siswa'])){
            $id_siswa=htmlspecialchars($_GET["id_siswa"]);

            $sql="delete from siswa where id_siswa='$id_siswa' ";
            $hasil=mysqli_query($kon,$sql);

            // kondisi apakah berhasil atau tidak
                if ($hasil) {
                    header("Location:index.php");
                }
                else {
                    echo "<div class='alert alert=danger'> Data gagal dihapus.</div>";
                }
            
            }
    ?>
    
    <tr class="table-danger">
        <br>
        <thread>
        <tr>
        <table class="my-3 table table-bordered">
            <tr class="table-primary">
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Email</th>
                <th colspan='2'>Aksi</th>
            </tr>
        </table>
        </tr>
        </thread>

        <?php
        include "koneksi.php";
        $sql="select * from siswa order by id_siswa desc";

        $hasil=mysqli_query($kon,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)){
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data["nama"]; ?></td>
                <td><?php echo $data["alamat"]; ?></td>
                <td><?php echo $data["no_telp"]; ?></td>
                <td><?php echo $data["email"]; ?></td>
                <td>
                    <a href="update.php?id_siswa=<?php echo htmlspecialchars($data['id_siswa']); ?>" class="btn btn-warning" role="button">Update</a>
                    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_siswa=<?php echo $data['id_siswa']; ?>" class="btn btn-danger" role="button">Delete</a> 
                </td>
            </tr>
            </tbody>
            <?php
        }
        ?>
        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
    </tr>
    </div>
</body>
</html>