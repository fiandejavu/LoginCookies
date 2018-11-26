<?php
    //membuat koneksi
    $conn=mysqli_connect("localhost","root","","webdatabase");
    //Cek koneksi
    if(!$conn)
    {
        die('Koneksi Error : '.mysqli_connect_errno()
        .' - '.mysqli_connect_error());
    }
    //Ambil Data
    $result=mysqli_query($conn,"SELECT * FROM mahasiwa");
    
    //function query
    function query($query_kedua)
    {
        global $conn;
        $result = mysqli_query($conn,$query_kedua);
        $rows =[];
        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[]=$row;
        }
        return $rows;
    }

    function tambah($data)
    {
        global $conn;
        
        $nama=htmlspecialchars($data["Nama"]);
        $nim=htmlspecialchars($data["Nim"]);
        $email=htmlspecialchars($data["Email"]);
        $jurusan=htmlspecialchars($data["Jurusan"]);
        //$gambar=htmlspecialchars($data["Gambar"]);
        $gambar=upload();
        if(!$gambar){
            return false;
        }

        $query= "INSERT INTO mahasiwa VALUES
                ('','$nama','$nim','$email','$jurusan','$gambar')";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
    }

    function hapus($id)
    {
        global $conn;
        mysqli_query($conn,"DELETE FROM mahasiwa WHERE id =$id ");
        return mysqli_affected_rows($conn);
    }
    function edit($data){
        global $conn;
        $id=$data["id"];
        $nama=htmlspecialchars($data["Nama"]);
        $nim=htmlspecialchars($data["Nim"]);
        $email=htmlspecialchars($data["Email"]);
        $jurusan=htmlspecialchars($data["Jurusan"]);
        $gambar=htmlspecialchars($data["Gambar"]);

        $query= "UPDATE mahasiwa SET
                Nama = '$nama',
                Nim = '$nim',
                Email = '$email',
                Jurusan = '$jurusan',
                Gambar = '$gambar' WHERE id = $id ";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
    }
    function cari($keyword){
        $sql="SELECT * FROM mahasiwa
            WHERE
            Nama LIKE '%$keyword%' OR
            Nim LIKE '%$keyword%' OR
            Email LIKE '%$keyword%' OR
            Jurusan LIKE '%$keyword%' ";
            return query($sql);
    }
    function upload(){
        $nama_file=$_FILES['Gambar']['name'];
        $ukuran_file=$_FILES['Gambar']['size'];
        $error=$_FILES['Gambar']['error'];
        $tmpfile=$_FILES['Gambar']['tmp_name'];

        if($error===4){
            echo "
                <script>
                alert('Tidak ada gambar yang diupload');
                </script>";
            return false;
        }

        $jenis_gambar=['jpg', 'jpeg', 'gif'];
        $pecah_gambar=explode('.',$nama_file);
        $pecah_gambar=strtolower(end($pecah_gambar));
        if(!in_array($pecah_gambar,$jenis_gambar)){
            echo "
                <script>
                    alert('yang anda upload bukan file gambar);
                </script>";
            return false;
        }

        if($ukuran_file > 1000000){
            echo "
                <script>
                    alert('ukuran gambar terlalu besar');
                </script>";
            return false;
        }

        move_uploaded_file($tmpfile,'img/'.$nama_file);
        return $nama_file;
    }
    function registrasi($data)
    {
        global $conn;
        //stripsclashes digunakan untuk menghilangkan blackslashes
        $username=strtolower(stripcslashes($data['username']));
        //mysqli_real_escape_string untuk memberikan perlindungan terhadap karakter-karakter unik (sql_injection)
        //pada mysqli_real_escape_string terdapat 2 parameter
        $password=mysqli_real_escape_string($conn,$data['password']);
        $password2=mysqli_real_escape_string($conn,$data['password2']);
        //cek username sudah ada apa belum
        $result=mysqli_query($conn,"SELECT username FROM user WHERE username='$username'");
        //cek kondisi jika line 175 bernilai true maka cetak echo
        if(mysqli_fetch_assoc($result)) {
            echo "
                <script>
                    alert('username sudah ada');
                </script>";
                //agar proses insertnya gagal
                return false;
        }
        //cek konfirmasi password
        if($password!==$password2) {
            echo "
                <script>
                    alert('password anda tidak sama');
                </script>";
                return false;
        }
        //tambahkan user baru k database
        mysqli_query($conn,"INSERT INTO user VALUES('','$username','$password')");
        return mysqli_affected_rows($conn);

    }
?>