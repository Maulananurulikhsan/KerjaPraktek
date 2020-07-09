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
                        <h1 class="h3 mb-4 text-gray-800">Tes</h1>
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <?php
                                    $conn = mysqli_connect('localhost', 'root', '', 'project');

                                    $query = "SELECT * FROM tes";
                                    $query_run = mysqli_query($conn, $query);
                                    ?>
                                    <table class="table table-striped table-responsive" id="table-1">
                                        <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama Karyawan</th>
                                                <th class="text-center">Jabatan</th>
                                                <th class="text-center">Gaji</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $no = 1;
                                        if ($query_run) {
                                            foreach ($query_run as $d) {
                                        ?>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><?php echo $no++; ?></td>
                                                        <td class="text-center"><?php echo $d['nama_karyawan']; ?></td>
                                                        <td class="text-center"><?php echo $d['jabatan']; ?></td>
                                                        <td class="text-center"><?php echo $d['gaji']; ?></td>
                                                    </tr>
                                            <?php
                                            }
                                        } else {
                                            echo "No record Found";
                                        }
                                            ?>
                                                </tbody>

                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                                    <i class="fa fa-plus"></i>
                                                    Tambah Data
                                                </button>
                                                <hr class="sidebar-divider">
                                                <!-- <div class="px-3">
                                                    <a href="laporan/cetak.php" target="_blank" class="btn btn-info btn-md"><i class="fa fa-print"></i> Cetak</a>
                                                    <a href="laporan/exportexcel.php" target="_blank" class="btn btn-default btn-md"><i class="fa fa-print"></i> Export Excel</a>
                                                    <hr class="sidebar-divider">
                                                </div> -->

                                    </table>
                                </div>
                            </div>
                        </div>
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

    <!-- Modal Start -->
    <div class="modal fade" id="modalTambah" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="inserttes.php" method="post" class="form-user" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="nama_karyawan">Nama Karyawan</label>
                            <select name="nama_karyawan" id="nama_karyawan" class="form-control" required>
                                <option value=""> --- Pilih Nama --- </option>
                                <?php
                                $query = mysqli_query($conn, "select * from karyawan");
                                while ($d = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $d['nama_karyawan']; ?>"><?php echo $d['nama_karyawan']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="jabatan">Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-control" required>
                                <option value=""> --- Pilih Jabatan --- </option>
                                <?php
                                $query = mysqli_query($conn, "select * from jabatan");
                                while ($d = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $d['jabatan']; ?>"><?php echo $d['id_jabatan']; ?> - <?php echo $d['jabatan']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="form-group">
                                <label class="control-label" for="gaji">Gaji</label>
                                <select name="gaji" id="gaji" class="form-control" required>
                                    <option value=""> --- Pilih Gaji --- </option>
                                    <?php
                                    $query = mysqli_query($conn, "select * from gaji");
                                    while ($d = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $d['gaji']; ?>"><?php echo $d['gaji']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </>

                            <div>
                                <button type="submit" name="insertdata" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                                <button type="reset" class="btn btn-warning m-t-15 waves-effect">Reset</button>
                            </div>
                </form>
            </div>
        </div>

    </div>
    <!-- Modal end -->
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
    <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>

    <!-- <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script> -->
</body>

</html>