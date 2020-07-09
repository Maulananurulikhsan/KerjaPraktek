<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$email = $_POST['email'];
$password = md5($_POST['password']);

// menyeleksi data user dengan username dan password yang sesuai
$masuk = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($masuk);

// cek apakah username dan password di temukan pada database
if ($cek > 0) {

    $data = mysqli_fetch_assoc($masuk);

    // cek jika user login sebagai admin
    if ($data['level'] == "Admin") {

        // buat session login dan username
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['image'] = $data['image']; //belonn di define
        $_SESSION['level'] = "Admin";
        // alihkan ke halaman dashboard admin
        header("location: Dashboard.php");

        // cek jika user login sebagai mahasiswa
    } else if ($data['level'] == "User") {
        // buat session login dan username
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['image'] = $data['image'];
        $_SESSION['level'] = "User";
        // alihkan ke halaman dashboard mahasiswa
        header("location: user/Dashboard2.php");
    }
} else {
    header("location:index.php?pesan=gagal");
}
