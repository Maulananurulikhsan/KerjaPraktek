<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $delete = mysqli_query($conn, "DELETE FROM karyawan WHERE id = '" . $_GET['id'] . "' ");
}
header("location:karyawan.php?pesan=hapus");
