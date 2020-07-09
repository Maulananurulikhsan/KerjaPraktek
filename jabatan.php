<?php
session_start();
include 'koneksi.php';
include 'fungsi.php';
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
                        <h1 class="h3 mb-4 text-gray-800">Jabatan</h1>
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php
                                    $conn = mysqli_connect('localhost', 'root', '', 'project');

                                    $query = "SELECT * FROM jabatan";
                                    $query_run = mysqli_query($conn, $query);
                                    ?>

                                    <table class="table table-striped" id="table-1">

                                        <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">ID Jabatan</th>
                                                <th class="text-center">Jabatan</th>
                                                <th class="text-center">Tunjangan</th>
                                                <th class="text-center">Gapok</th>
                                                <th class="text-center">Action</th>
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
                                                        <td class="text-center"><?php echo $d['id_jabatan']; ?></td>
                                                        <td class="text-center"><?php echo $d['jabatan']; ?></td>
                                                        <td class="text-center"><?php echo buatRp($d['tunjangan']); ?></td>
                                                        <td class="text-center"><?php echo buatRp($d['gapok']); ?></td>
                                                        <td align="center">
                                                            <a href="edit_jabatan.php?id=<?php echo $d['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                                            <a href="delete_jabatan.php?id=<?php echo $d['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>Delete</a>
                                                        </td>
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
                                </div>
                                </table>
                            </div>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Data Jabatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="insert_jabatan.php" method="post" class="form-user" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="jabatan">Id Jabatan</label>
                            <input type="text" name="id_jabatan" id="id_jabatan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" id="jabatan" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="tunjangan">Tunjangan</label>
                            <input type="number" name="tunjangan" class="form-control" id="tunjangan" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="gapok">Gapok</label>
                            <input type="number" name="gapok" class="form-control" id="gapok" required>
                        </div>
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