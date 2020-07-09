<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $delete = mysqli_query($conn, "DELETE FROM master_gaji WHERE id_master_gaji = '" . $_GET['id'] . "' ");
}
header("location:gaji.php?pesan=hapus");
