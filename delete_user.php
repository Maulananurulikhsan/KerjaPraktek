<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $delete = mysqli_query($conn, "DELETE FROM user WHERE id = '" . $_GET['id'] . "' ");
}
header("location:user.php?pesan=hapus");
