<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $delete = mysqli_query($conn, "DELETE FROM departemen WHERE id = '" . $_GET['id'] . "' ");
}
header("location:departemen.php?pesan=hapus");
