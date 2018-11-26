<?php
    require 'functions.php';
   
    $id=$_GET["id"];
    $mhs=query("SELECT * FROM mahasiwa WHERE id=$id")[0];
    
    //cek apakah button submit di tekan atau belum
    if(isset($_POST['submit']))
    {
        //cek sukses data ditambah menggunakan function tambah pada functions.php
        if(edit($_POST)>0)
        {
            echo"
            <script>
                alert('data berhasil diperbaharui');
                document.location.href='index.php';
                </script>
            ";
        } else {
            echo "
            <script>
                alert('data gagal diperbaharui');
                document.location.href='edit.php';
                </script>";
            echo "<br>";
            echo mysqli_error($conn);
        }
    }
    session_start();
    if(!isset($_SESSION["login"])){
        echo $_SESSION["login"];
        header("Location:login.php");
        exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Halaman Utama</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tambah_data.php">Tambah Data</a>
        </li>
    </ul>
    <h1><center>Update Data Mahasiswa</h1>
    <form class="form-horizontal" action="" method="post">
                    
            <input type="hidden" name="id"  value="<?= $mhs["id"]; ?>" required class="form-control"></div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="Nama">Nama</label>
                <div class="col-sm-8">
                    <input type="text" name="Nama" id="Nama" value="<?= $mhs["Nama"]; ?>" required class="form-control"></div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="Nim">Nim</label>
                <div class="col-sm-8">
                    <input type="text" name="Nim" id="Nim" required value="<?= $mhs["Nim"]; ?>" required class="form-control"></div>
                </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="Email">Email</label>
                <div class="col-sm-8">
                    <input type="text" name="Email" id="Email" required value="<?= $mhs["Email"]; ?>" required class="form-control"></div>
                </div>
                <div class="form-group">
            <label class="control-label col-sm-2" for="Jurusan">Jurusan</label>
                <div class="col-sm-8">
                    <input type="text" name="Jurusan" id="Jurusan" required value="<?= $mhs["Jurusan"]; ?>" required class="form-control"></div>
                </div>
                <div class="form-group">
            <label class="control-label col-sm-2" for="Gambar">Gambar</label>
                <div class="col-sm-8">
                    <input type="text" name="Gambar" id="Gambar" required value="<?= $mhs["Gambar"]; ?>" required class="form-control"></div>
                </div>
            <label class="control-label col-sm-2" for="Gambar"></label>
                <div class="col-sm-8" align="center">
                <button type="submit" name="submit">Update</button></div>
                </div>
    </form>
</body>
</html>