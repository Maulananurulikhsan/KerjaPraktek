<?php
$conn = mysqli_connect('localhost', 'root', '', 'project');

if (isset($_POST['insertdata'])) {
    $kode_golongan = $_POST['kode_golongan'];
    $nama_golongan = $_POST['nama_golongan'];
    $tunjangan_suami_istri = $_POST['tunjangan_suami_istri'];
    $tunjangan_anak = $_POST['tunjangan_anak'];
    $uang_makan = $_POST['uang_makan'];
    $uang_lembur = $_POST['uang_lembur'];
    $askes = $_POST['askes'];

    $query = "INSERT INTO golongan VALUES ('','$kode_golongan','$nama_golongan','$tunjangan_suami_istri', '$tunjangan_anak', '$uang_makan', '$uang_lembur', '$askes')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo '<script> alert("Data Saved"); </script>';
        header('location: golongan.php');
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
