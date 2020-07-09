<?php
$conn = mysqli_connect('localhost', 'root', '', 'project');

if (isset($_POST['insertdata'])) {
    $nama_karyawan = $_POST['nama_karyawan'];
    $jabatan = $_POST['jabatan'];
    $gaji = $_POST['gaji'];

    $query = "INSERT INTO tes VALUES ('','$nama_karyawan','$jabatan','$gaji')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo '<script> alert("Data Saved"); </script>';
        header('location: tes.php');
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
