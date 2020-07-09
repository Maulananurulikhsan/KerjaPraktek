<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $delete = mysqli_query($conn, "DELETE FROM golongan WHERE id = '" . $_GET['id'] . "' ");
}
header("location:golongan.php?pesan=hapus");
