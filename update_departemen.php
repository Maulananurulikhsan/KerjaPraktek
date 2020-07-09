<?php
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$id_dept = $_POST['id_dept'];
$departemen = $_POST['departemen'];


// update data ke database
mysqli_query($conn, "UPDATE departemen set id_dept='$id_dept', departemen='$departemen' where id='$id'");

// mengalihkan halaman kembali ke index.php
header("location:departemen.php?pesan=update");
