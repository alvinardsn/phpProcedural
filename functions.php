<?php 
    
     //koneksi database
    $conn = mysqli_connect("localhost", "root", "", "phpdasar");
    
    // membaca data di database
    function query($query){
        global $conn; //variable global untuk koneksi database

        $result = mysqli_query($conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result) ){
            $rows[] = $row;
        }
        return $rows;
    }
    
    // menambahkan data di database
    function tambah ($data){
        global $conn; //variable global untuk koneksi database

        // ambil data dari setiap elemen dalam form
        $npm = htmlspecialchars($data["npm"]);
        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);
        $jurusan = htmlspecialchars($data["jurusan"]);

        // upload gambar
        $gambar = upload();
        if (!$gambar){
            return false;
        }

        // query database untuk input data
        $query = "INSERT INTO mahasiswa VALUES
                 ('', '$npm', '$nama', '$email', '$jurusan', '$gambar')";

        mysqli_query($conn, $query);
         
        //mysqli_affected_rows berfungsi untuk mengindikasi data yang sudah masuk ke database. jika data sudah masuk maka akan bertambah menjadi +1
        // hal ini berfungsi untuk notifikasi berhasil atau tidaknya data disimpan
        return mysqli_affected_rows($conn);
    }

    function upload(){

        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if ( $error === 4){
            echo"<script>
                    alert('pilih gambar terlebih dahulu!');
                    document.location.href = 'tambah.php';
                </script>";
            return false;
        }

        // cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'pdf'];
        $ekstensiGambar = explode('.', $namaFile); // pengembalilan file ekstensi dengan menggunakan function explode
        $ekstensiGambar = strtolower(end($ekstensiGambar)); // pengeubahan format gambar dan pengambilan jenis file ekstensi

        if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ){
            echo "<script>
                    alert ('yang anda upload bukan gambar');
                  </script>";
                    return false;
        }

        // cek jika ukurannya terlalu besar
        if ( $ukuranFile > 1000000){
            echo "<script>
                    alert ('ukuran terlalu besar');
                  </script>";
                    return false;
        }

        // lolos pengecekkan gambar dan siap di upload
        // generate nama gambar baru agar tidak ada nama yg sama ketika terinput ke database
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
        
        move_uploaded_file($tmpName, 'img/'.$namaFileBaru);

        return $namaFileBaru;
    }

    function hapus ($id){
        global $conn; //variable global untuk koneksi database

        mysqli_query($conn, "DELETE FROM mahasiswa where id = $id");
        //mysqli_affected_rows berfungsi untuk mengindikasi data yang sudah masuk ke database. jika data sudah masuk maka akan bertambah menjadi +1
        // hal ini berfungsi untuk notifikasi berhasil atau tidaknya data dihapus
        return mysqli_affected_rows($conn);
    }

    function ubah ($data){
        global $conn; //variable global untuk koneksi database

        // ambil data dari setiap elemen dalam form
        $id = $data["id"];
        $npm = htmlspecialchars($data["npm"]);
        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);
        $jurusan = htmlspecialchars($data["jurusan"]);
        $gambarLama =  htmlspecialchars($data["gambarLama"]);
    
        // cek apakah user pilih ganti gambar baru atau tidak
        if ($_FILES['gambar']['error'] === 4){
            $gambar = $gambarLama;
        } else {
            $gambar = upload();
        }
        

        // query database untuk input data
        $query = "UPDATE mahasiswa SET
                    npm = '$npm',
                    nama = '$nama', 
                    email = '$email', 
                    jurusan = '$jurusan', 
                    gambar = '$gambar'
                        WHERE id = $id
                    ";

       mysqli_query($conn, $query);
        
       // mysqli_affected_rows berfungsi untuk mengindikasi data yang sudah masuk ke database. jika data sudah masuk maka akan bertambah menjadi +1
       // hal ini berfungsi untuk notifikasi berhasil atau tidaknya data diubah
       return mysqli_affected_rows($conn);
    }

    function cari($keyword){
        $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR
        npm LIKE '%$keyword%'
        OR email LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%'" ;

        return query($query);
    }

    function registrasi ($data){
        global $conn;

         // functions stripslashes berfungsi untuk membersihkan karakter penulisan yang hanya pengambilan huruf saja
         // sedangkan strtolower berfungsi untuk membuat hasil inputtan menjadi huruf kecil semua
        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);

        // cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
        if (mysqli_fetch_assoc($result)){
            echo "<script>
                alert('username sudah terdaftar');
            </script>";
            return false;
        }
        // cek konfrimmasi password
        if ( $password !== $password2 ){
            echo "<script>
                alert('konfrimasi password tidak sesuai!');
            </script>";
            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // tambahkan userbaru ke database
        mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

        return mysqli_affected_rows($conn);
    }
