<?php
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$nik = $_POST['nik'];
$nama_karyawan = $_POST['nama_karyawan'];
$usia = $_POST['usia'];
$nama_golongan = $_POST['nama_golongan'];
$tanggal_masuk = $_POST['tanggal_masuk'];
$nomor_telepon  = $_POST['nomor_telepon'];
$alamat = $_POST['alamat'];
$departemen = $_POST['departemen'];
$jabatan = $_POST['jabatan'];
$status = $_POST['status'];
$jumlah_anak = $_POST['jumlah_anak'];

// update data ke database
mysqli_query($conn, "UPDATE karyawan set nik='$nik', nama_karyawan='$nama_karyawan', usia='$usia', nama_golongan='$nama_golongan', tanggal_masuk='$tanggal_masuk', nomor_telepon='$nomor_telepon', alamat='$alamat', departemen='$departemen', jabatan='$jabatan', status='$status', jumlah_anak='$jumlah_anak' where id='$id'");

// mengalihkan halaman kembali ke index.php
header("location:karyawan.php?pesan=update");
