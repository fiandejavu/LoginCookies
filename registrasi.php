<?php
    require 'functions.php';
    if(isset($_POST['register'])) {
        if(registrasi($_POST)>0) {
            echo "
                <style>
                    alert('user berhasil ditambahkan');
                </style>";
        } else {
            echo mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Registrasi</title>
    <style>
        label {
            display:block;
        }
    </style>
</head>
<body>
<ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
        </li>
</ul>
    <h1> Halaman Registrasi </h1>
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
            <label class="control-label col-sm-2" for="username">Username :</label>
                <div class="col-sm-8">
                    <input type="text" name="username" id="username" required class="form-control"></div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password :</label>
                <div class="col-sm-8">
                    <input type="password" name="password" id="password" required class="form-control"></div>
                </div>
            <label class="control-label col-sm-2" for="password2">Konfirmasi Password :</label>
                <div class="col-sm-8">
                    <input type="password" name="password2" id="password2" required class="form-control"></div>
                </div>
            <label class="control-label col-sm-2" for="submit"></label>
                <div class="col-sm-8" align="center">
                <button type="submit" name="register">Registrasi</button></div>
    </form>
</body>
</html>