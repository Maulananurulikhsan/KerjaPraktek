<?php
$conn = mysqli_connect('localhost', 'root', '', 'project');

if (isset($_POST['insertdata'])) {
    $nik = $_POST['nik'];
    $nama_karyawan = $_POST['nama_karyawan'];
    $usia = $_POST['usia'];
    $nama_golongan = $_POST['nama_golongan'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status'];
    $jumlah_anak = $_POST['jumlah_anak'];

    $query = "INSERT INTO karyawan VALUES ('','$nik','$nama_karyawan','$usia', '$nama_golongan','$tanggal_masuk','$nomor_telepon','$alamat','$departemen','$jabatan','$status','$jumlah_anak')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo '<script> alert("Data Saved"); </script>';
        header('location: karyawan.php');
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
