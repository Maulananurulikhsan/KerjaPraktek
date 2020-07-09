<?php
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$id_jabatan = $_POST['id_jabatan'];
$jabatan = $_POST['jabatan'];
$tunjangan = $_POST['tunjangan'];


// update data ke database
mysqli_query($conn, "UPDATE jabatan set id_jabatan='$id_jabatan', jabatan='$jabatan', tunjangan='$tunjangan' where id='$id'");

// mengalihkan halaman kembali ke index.php
header("location:jabatan.php?pesan=update");
