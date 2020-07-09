<?php
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$image = $_FILES['image']['name'];

if ($image != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $image); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['image']['tmp_name'];
    $angka_acak     = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $image; //menggabungkan angka acak dengan nama file sebenarnya
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, 'assets/img/profile/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
        // update data ke database
        $query =  "UPDATE user SET username = '$username', email = '$email', image = '$nama_gambar_baru' where id='$id'";
        $query_run = mysqli_query($conn, $query);

        if (!$query_run) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            //tampil alert dan akan redirect ke halaman index.php
            //silahkan ganti index.php sesuai halaman yang akan dituju
            echo "<script>alert('Data berhasil ditambah.');window.location='Dashboard.php';</script>";
        }
    } else {
        //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
        echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='edit_profile.php';</script>";
    }
} else {
    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
    $query =  "UPDATE user SET username = '$username', email = '$email', image = '$nama_gambar_baru' where id='$id'";
    $query_run = mysqli_query($conn, $query);
    // periska query apakah ada error
    if (!$query_run) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
        echo "<script>alert('Data berhasil diubah.');window.location='Dashboard.php';</script>";
    }
}
