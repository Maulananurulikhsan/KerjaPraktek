<?php
//Include file koneksi ke database
include "koneksi.php";

//menerima nilai dari kiriman form pendaftaran
$username = $_POST["username"];
$email = $_POST["email"];
$password = md5($_POST["password"]); //untuk password digunakan enskripsi md5
$password_confirm = $_POST['password_confirm'];


//Query input menginput data kedalam tabel anggota
$sql = "INSERT INTO user (username,email,password) values
		('$username','$email','$password')";

//Mengeksekusi/menjalankan query diatas	
$hasil = mysqli_query($conn, $sql);

//Kondisi apakah berhasil atau tidak
if ($hasil) {
    header('location:index.php');
} else {
    echo "Gagal simpan data anggota";
    exit;
}
