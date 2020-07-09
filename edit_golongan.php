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
                        <h1 class="h3 mb-4 text-gray-800">Edit Data Golongan</h1>
                        <form action="update_golongan.php" method="post" class="form-user" enctype="multipart/form-data">
                            <?php
                            include 'koneksi.php';
                            $query = "SELECT * FROM golongan where id = $_GET[id]";
                            $query_run = mysqli_query($conn, $query);
                            $result = mysqli_fetch_assoc($query_run);

                            ?>
                            <div class="form-group">
                                <label class="control-label">Kode Golongan</label>
                                <input type="hidden" name="id" value="<?php echo $result['id']; ?>" class="form-control" required>
                                <input type=" text" name="kode_golongan" value="<?php echo $result['kode_golongan']; ?>" id="kode_golongan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="nama_golongan">Nama Golongan</label>
                                <input type="text" name="nama_golongan" value="<?php echo $result['nama_golongan']; ?>" class="form-control" id="nama_golongan" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="tunjangan_suami_istri">Tunjangan S/I</label>
                                <input type="number" name="tunjangan_suami_istri" value="<?php echo $result['tunjangan_suami_istri']; ?>" class="form-control" id="tunjangan_suami_istri" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="tunjangan_anak">Tunjangan Anak</label>
                                <input type="number" name="tunjangan_anak" value="<?php echo $result['tunjangan_anak']; ?>" class="form-control" id="tunjangan_anak" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="uang_makan">Uang Makan</label>
                                <input type="number" name="uang_makan" value="<?php echo $result['uang_makan']; ?>" class="form-control" id="uang_makan" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="uang_lembur">Uang Lembur</label>
                                <input type="number" name="uang_lembur" value="<?php echo $result['uang_lembur']; ?>" class="form-control" id="uang_lembur" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="askes">askes</label>
                                <input type="number" name="askes" value="<?php echo $result['askes']; ?>" class="form-control" id="askes" required>
                            </div>
                            <div>
                                <a href="golongan.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
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