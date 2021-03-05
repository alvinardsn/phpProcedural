<?php 
    session_start();
    require 'functions.php';

    if ( !isset($_SESSION["login"]) ){
        header("Location: login.php");
        exit;
    }

    //connect database
    $conn = mysqli_connect("localhost", "root", "", "phpdasar");

    //ambul data di URL
    $id = $_GET["id"];

    //query data mahasiswa berdasarkan id
    $mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

    // cek apakah tombol submit sudah ditekan atau belum
        if ( isset($_POST["submit"]) ) {

        // cek apakah data berhasil diubah atau tidak
        if ( ubah($_POST) > 0 ){
            echo "
                <script>
                    alert('data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>
                ";
        } else {
            echo "
                <script>
                    alert('data gagal diubah!');
                    document.location.href = 'index.php';
                </script>
                ";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah data mahasiswa</title>
</head>
<body>
    <h1>Ubah data mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
            <ul>
                <li>
                    <label for="npm">NPM</label>
                    <input type="text" name="npm" id="npm" required value="<?= $mhs["npm"]; ?>">
                </li>
                <li>
                    <label for="nama">Nama : </label>
                    <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
                </li>
                <li>
                    <label for="email">email : </label>
                    <input type="text" name="email" id="email" required value="<?= $mhs["email"]; ?>">
                </li>
                <li>
                    <label for="jurusan">jurusan : </label>
                    <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>">
                </li>
                <li>
                    <label for="gambar">gambar : </label> <br>
                    <img src="img/<?=$mhs ['gambar'];?>"width = "100"> <br>
                    <input type="file" name="gambar" id="gambar">
                </li>
                <li>
                    <button type="submit" name="submit">Ubah data!</button>
                </li>
            </ul>
    </form>
    
</body>
</html>