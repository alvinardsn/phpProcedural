<?php 
    session_start();

    if ( !isset($_SESSION["login"]) ){
        header("Location: login.php");
        exit;
    }
    
    // menghubungkan halaman index dengan halaman file
    require 'functions.php';

    $mahasiswa = query("SELECT * FROM mahasiswa");

    // tombol cari diklik
    if (isset($_POST["cari"]) ){
        $mahasiswa = cari($_POST["keyword"]);
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        .loader{
            width: 100px;
            position: absolute;
            top: 76px;
            left: 306px;
            z-index: -1;
            display: none;
        }
    </style>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <a href="logout.php"> Logout </a> | <a href="cetak.php" target="_blank">Cetak</a>
    <h1>Daftar Mahasiswa</h1>
    <a href="tambah.php">Tambah data Mahasiswa</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" size="40" placeholder="Masukkan keyword" autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari</button>
        <img src="img/loader.gif"class="loader">
    </form>

    <br>
    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No. </th>
                <th>Aksi</th>
                <th>Gambar</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jurusan</th>
            </tr>

            <!-- menampilkan data -->
            <?php $i=1; ?>
            <?php foreach ($mahasiswa as $mhs ):?>
            <tr>
                <td><?= $i;  ?></td>
                <td>
                    <a href="ubah.php?id=<?=$mhs["id"]; ?>">ubah</a> |
                    <a href="hapus.php?id=<?=$mhs["id"]; ?>" onclick="return confirm('yakin');">hapus</a>
                </td>
                <td><img src="img/<?=$mhs["gambar"] ?>" width="50"></td>
                <td><?= $mhs["npm"]; ?></td>
                <td><?= $mhs["nama"]; ?></td>
                <td><?= $mhs["email"]; ?></td>
                <td><?= $mhs["jurusan"]; ?></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>
    
</body>
</html>