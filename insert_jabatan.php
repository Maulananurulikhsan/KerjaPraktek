<?php
$conn = mysqli_connect('localhost', 'root', '', 'project');

if (isset($_POST['insertdata'])) {
    $id_jabatan = $_POST['id_jabatan'];
    $jabatan = $_POST['jabatan'];
    $tunjangan = $_POST['tunjangan'];
    $gapok = $_POST['gapok'];

    $query = "INSERT INTO jabatan VALUES ('','$id_jabatan','$jabatan','$tunjangan','$gapok')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo '<script> alert("Data Saved"); </script>';
        header('location: jabatan.php');
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
