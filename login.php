<?php
    session_start();
    //cek cookie
    if(isset($_COOKIE["login"])&& isset($_COOKIE["username"])){
        $id=$_COOKIE["id"];
        $key=$_COOKIE["key"];
        //ambil username berdasarkan id
        $resul=mysqli_query($conn,"SELECT username FROM user WHERE id=$id");
        $row=mysqli_fetch_assoc($result);
        //cek cookie dan username
        if($key === hash("sha256",$row["username"])){
            $_SESSION["login"]=true;
        }
    }

    if(isset($_SESSION["login"])){
        echo $_SESSION["login"];
        header("Location:login.php");
        exit;
    }

    require 'functions.php';

    if(isset($_POST["login"])){
        $username=$_POST["username"];
        $password=$_POST["password"];

        $result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username'");

        if(mysqli_num_rows($result)===1){
            $row=mysqli_fetch_assoc($result);
    
            if($password===$row["password"]) {
                $_SESSION["login"]=true;

                if(isset($_POST['remember'])){
                    setcookie('login','true',time()+60);
                    setcookie('key',hash(sha256,$row['username']),time()+60);
                }
                
                header("Location:index.php");
                exit;
            }
        }
        $error=true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="registrasi.php">Registrasi Baru</a>
        </li>
    </ul>
    <h1> Halaman Login </h1>
    <p></p>
    <?php if(isset($error)):?>
        <p style="color:red; font-style=bold">
        Username dan Passwordnya salah</p>
    <?php endif?>

    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
            <label class="control-label col-sm-2" for="username">Username</label>
                <div class="col-sm-8">
                    <input type="text" name="username" id="username" required class="form-control"></div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password</label>
                <div class="col-sm-8">
                    <input type="password" name="password" id="password" required class="form-control"></div>
                </div>
                <label class="control-label col-sm-2" for="submit"></label>
                <div class="col-sm-8" align="center">
                <button type="submit" name="login">Login</button></div>
    </form>
</body>
</html>