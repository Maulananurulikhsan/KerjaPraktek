<?php
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$kode_golongan = $_POST['kode_golongan'];
$nama_golongan = $_POST['nama_golongan'];
$tunjangan_suami_istri = $_POST['tunjangan_suami_istri'];
$tunjangan_anak = $_POST['tunjangan_anak'];
$uang_makan  = $_POST['uang_makan'];
$uang_lembur = $_POST['uang_lembur'];
$askes = $_POST['askes'];

// update data ke database
mysqli_query($conn, "UPDATE karyawan set kode_golongan='$kode_golongan', nama_golongan='$nama_golongan', tunjangan_suami_istri='$tunjangan_suami_istri', tunjangan_anak='$tunjangan_anak', uang_makan='$uang_makan', uang_lembur='$uang_lembur', askes='$askes' where id='$id'");

// mengalihkan halaman kembali ke index.php
header("location:golongan.php?pesan=update");
