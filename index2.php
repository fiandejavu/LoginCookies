<?php
require 'functions.php';
$mahasiswa=query("SELECT * FROM mahasiswa")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
</head>
<body>
<h1> Daftar Mahasiswa </h1>
<table border="1" cellpadding="10" cellspacing="0">
<tr>
    <th>No.</th>
    <th>Nama</th>
    <th>Nim</th>
    <th>Email</th>
    <th>Jurusan</th>
    <th>Gambar</th>
    <th>Aksi.</th>
</tr>
<?php $i=1 ?>

<?php foreach($mahasiswa as $row):?>
<tr>
    <td><?= $i ?></td>
    <td><?= $row["Id"]; ?></td>
    <td><?= $row["Nama"]; ?></td>
    <td><?= $row["Nim"]; ?></td>
    <td><?= $row["Email"]; ?></td>
    <td><?= $row["Jurusan"]; ?></td>
    <td><img src="img/<?php echo $row["Gambar"]; ?>" alt="" height="100" width="100" srcset=""></td>
    <td>
        <a href="">Edit</a>
        <a href="">Hapus</a>
    </td>
</tr>
<?php $i++ ?>
<?php endforeach;?>
</table>
</body>
</html>