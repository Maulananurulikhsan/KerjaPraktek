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

            <!-- end navbar--
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <!-- add content here -->
                        <h1 class="h3 mb-4 text-gray-800">Edit Data Departemen</h1>
                        <form action="update_departemen.php" method="post" class="form-user" enctype="multipart/form-data">
                            <?php
                            include 'koneksi.php';
                            $query = "SELECT * FROM departemen where id = $_GET[id]";
                            $query_run = mysqli_query($conn, $query);
                            $result = mysqli_fetch_assoc($query_run);

                            ?>
                            <div class="form-group">
                                <label class="control-label">ID Jabatan</label>
                                <input type="hidden" name="id" value="<?php echo $result['id']; ?>" class="form-control" required>
                                <input type="text" name="id_dept" value="<?php echo $result['id_dept']; ?>" id="id_dept" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="departemen">Jabatan</label>
                                <input type="text" name="departemen" value="<?php echo $result['departemen']; ?>" class="form-control" id="departemen" required>
                            </div>
                            <div>
                                <a href="departemen.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
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