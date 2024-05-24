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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_peserta
    if (isset($_GET['id_peserta'])) {
        $id_peserta=input($_GET["id_peserta"]);

        $sql="select * from peserta where id_peserta=$id_peserta";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_peserta=htmlspecialchars($_POST["id_peserta"]);
        $no_r=input($_POST["no_r"]);
        $nm=input($_POST["nm"]);
        $fk=input($_POST["fk"]);
        $no_hp=input($_POST["no_hp"]);
        $sts=input($_POST["sts"]);

        //Query update data pada tabel anggota
        $sql="update peserta set
			no_r='$no_r',
			nm='$nm',
			fk='$fk',
			no_hp='$no_hp',
			sts='$sts'
			where id_peserta=$id_peserta";

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
    <br>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nomor Registrasi :</label>
            <input type="text" name="no_r" class="form-control" placeholder="Masukan Nomor Registrasi" required />

        </div>
        <div class="form-group">
            <label>Nama Produk :</label>
            <input type="text" name="nm" class="form-control" placeholder="Masukan Nama Produk" required/>
        </div>
        <div class="form-group">
            <label>Nama Pembuat :</label>
            <input type="text" name="fk" class="form-control" placeholder="Masukan Nama Pembuat" required/>
        </div>
        <div class="form-group">
            <label>No HP :</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" required/>
        </div>
        <div class="form-group">
            <label>Status :</label>
            <textarea name="sts" class="form-control" rows="5"placeholder="Masukan Status" required></textarea>
        </div>

        <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>