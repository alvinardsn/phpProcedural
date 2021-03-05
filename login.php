<?php
    session_start();
    require 'functions.php';

    // 1. cek cookie sederhana
    // if ( isset ($_COOKIE['login']) ){
    //     if( $_COOKIE['login'] == 'true'){
    //         $_SESSION['login'] = true;
    //     }
    // }

    // 2. cek cookie enkripsi user id dan username
    if (isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key']; //key merupakan name dari cookie

        // ambil username berdasarkan id
        $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
        $row = mysqli_fetch_assoc($result);

        // cek cookie. pencocokkan key(username) yang value key yang sudah teracak dengan username di database
        if( $key === hash('sha256', $row['username']) ){
            $_SESSION['login'] = true;
        }
    }

    if( isset($_SESSION["login"])){
        header("Location: index.php");
        exit;
    }

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // cek username ada atau tidak di database
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        if(mysqli_num_rows($result) === 1){

            // cek password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])){
                // set session
                $_SESSION["login"] = true;

                // cek remember me
                if( isset($_POST['remember']) ){
                    // 2. enkripsi cookie dengan user id dan username
                    setcookie('id', $row['id'], time() + 60 );
                    setcookie('key', hash('sha256', $row['username']), time() + 60); // username di acak oleh algoritma hash

                    // 1. buat cookie sederhana
                    // pembuatan cookie menggunakan 3 parameter, contoh -> setcookie('nama cookie', 'isi cookie', 'waktu cookie')
                    // setcookie('login', 'true', time() + 60 );
                }

                header("Location: index.php");
                exit;
            }
        }
        $error = true;
    }

    if(isset($_POST["register"])){
        header("Location: registrasi.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if(isset($error)) : ?>
        <p style="color:red; font-style:italic">username / password salah</p>
    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </li>
            <li>
                <button type="submit" name="login">Sign In</button>
                <button type="submit" name="register">Sign Up</button></a>
            </li>
        </ul>
    </form>
</body>
</html>