<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_siswa
    if (isset($_GET['id_siswa'])) {
        $id_siswa=input($_GET["id_siswa"]);

        $sql="select * from peserta where id_siswa=$id_siswa";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_siswa=htmlspecialchars($_POST["id_siswa"]);
        $nama=input($_POST["nama"]);
        $sekolah=input($_POST["sekolah"]);
        $jurusan=input($_POST["jurusan"]);
        $no_hp=input($_POST["no_hp"]);
        $alamat=input($_POST["alamat"]);

        //Query update data pada tabel anggota
        $sql="update siswa set
			nama='$nama',
			alamat='$alamat',
			no_telp='$no_telp',
			email='$email',
			where id_siswa=$id_siswa";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Anda" required />

        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Anda" required/>
        </div>
        <div class="form-group">
            <label>No Telp :</label>
            <input type="text" name="no_telp" class="form-control" placeholder="Masukan No Telpon Anda" required/>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email" class="form-control" placeholder="Masukan Email Anda" required/>
        </div>

        <input type="hidden" name="id_siswa" value="<?php echo $data['id_siswa']; ?>" />
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

    </form>
</div>
</body>
</html>