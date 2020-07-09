<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $delete = mysqli_query($conn, "DELETE FROM jabatan WHERE id = '" . $_GET['id'] . "' ");
}
header("location:jabatan.php?pesan=hapus");
