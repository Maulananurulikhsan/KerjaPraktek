<?php
$conn = mysqli_connect('localhost', 'root', '', 'project');

if (isset($_POST['insertdata'])) {
    $id_dept = $_POST['id_dept'];
    $departemen = $_POST['departemen'];

    $query = "INSERT INTO departemen VALUES ('','$id_dept','$departemen')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo '<script> alert("Data Saved"); </script>';
        header('location: departemen.php');
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
