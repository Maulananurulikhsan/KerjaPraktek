<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <!-- header -->
            <?php include 'header.php'; ?>

            <!-- end header -->
            <!--- navbar -->
            <div class="main-sidebar sidebar-style-2">
                <?php include 'navbar.php'; ?>
            </div>

            <!-- end navbar-->
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <!-- add content here -->
                        <h1 class="h3 mb-4 text-gray-800">Edit Data Karyawan</h1>
                        <form action="update_karyawan.php" method="post" class="form-user" enctype="multipart/form-data">
                            <?php
                            include 'koneksi.php';
                            $query = "SELECT * FROM karyawan where id = $_GET[id]";
                            $query_run = mysqli_query($conn, $query);
                            $result = mysqli_fetch_assoc($query_run);

                            ?>
                            <div class="form-group">
                                <label class="control-label">NIK</label>
                                <input type="hidden" name="id" value="<?php echo $result['id']; ?>" class="form-control" required>
                                <input type=" number" name="nik" value="<?php echo $result['nik']; ?>" id="nik" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="nama_karyawan">Nama Karyawan</label>
                                <input type="text" name="nama_karyawan" value="<?php echo $result['nama_karyawan']; ?>" class="form-control" id="nama_karyawan" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="usia">Usia</label>
                                <input type="number" name="usia" value="<?php echo $result['usia']; ?>" class="form-control" id="usia" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="olongan">Golongan</label>
                                <select name="nama_golongan" id="nama_golongan" class="form-control" required>
                                    <option value=""> --- Pilih Golongan --- </option>
                                    <?php
                                    $query = mysqli_query($conn, "select * from golongan");
                                    while ($d = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $d['nama_golongan']; ?>"><?php echo $d['kode_golongan']; ?> - <?php echo $d['nama_golongan']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="tanggal_masuk">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" value="<?php echo $result['tanggal_masuk']; ?>" class="form-control" id="tanggal_masuk" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="nomor_telepon">Nomor Telepon</label>
                                <input type="number" name="nomor_telepon" value="<?php echo $result['nomor_telepon']; ?>" class="form-control" id="nomor_telepon" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="alamat">Alamat</label>
                                <input type="text" name="alamat" value="<?php echo $result['alamat']; ?>" class="form-control" id="alamat" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="departemen">Departemen</label>
                                <select name="departemen" id="departemen" class="form-control" required>
                                    <option value=""> --- Pilih Departemen --- </option>
                                    <?php
                                    $query = mysqli_query($conn, "select * from departemen");
                                    while ($d = mysqli_fetch_array($query)) :
                                    ?>
                                        <option value="<?php echo $d['departemen']; ?>"><?php echo $d['id_dept']; ?> - <?php echo $d['departemen']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="jabatan">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control" required>
                                    <option value=""> --- Pilih Jabatan --- </option>
                                    <?php
                                    $query = mysqli_query($conn, "select * from jabatan");
                                    while ($d = mysqli_fetch_array($query)) :
                                    ?>
                                        <option value="<?php echo $d['jabatan']; ?>"><?php echo $d['id_jabatan']; ?> - <?php echo $d['jabatan']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value=""> --- Pilih Status --- </option>
                                    <?php
                                    $query = mysqli_query($conn, "select * from status");
                                    while ($d = mysqli_fetch_array($query)) :
                                    ?>
                                        <option value="<?php echo $d['status']; ?>"><?php echo $d['status']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="jumlah_anak">Jumlah Anak</label>
                                <input type="text" name="jumlah_anak" value="<?php echo $result['jumlah_anak']; ?>" class="form-control" id="jumlah_anak" required>
                            </div>
                            <div>
                                <a href="karyawan.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
                                <button type="submit" name="" class="btn btn-primary m-t-15 waves-effect">Update</button>
                            </div>
                        </form>
                    </div>
                </section>

            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2019 <div class="bullet"></div> Design By <a href="#">Redstar</a>
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/bundles/sweetalert/sweetalert.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="assets/js/page/datatables.js"></script>
    <script src="assets/js/page/sweetalert.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
</body>

</html>