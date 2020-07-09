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
            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>

                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="assets/img/profile/<?php echo $_SESSION['image']; ?>" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Hello <?php echo $_SESSION['username']; ?></div>
                            <a href="edit_profile.php" class="dropdown-item has-icon"> <i class="far
										fa-user"></i>Edit Profile
                            </a>
                            <a href="password.php" class="dropdown-item has-icon"> <i class="fas fa-lock"></i>
                                Change Password
                            </a>

                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="Dashboard.php"></i> <span class="logo-name"><?php echo $_SESSION['level']; ?></span>

                        </a>
                    </div>
                    <div class="sidebar-user">
                        <div class="sidebar-user-picture">
                            <img alt="image" src="assets/img/profile/<?php echo $_SESSION['image']; ?>">
                        </div>
                        <div class=" sidebar-user-details">
                            <div class="user-name"><?php echo $_SESSION['username']; ?></div>
                            <div class="user-role"><?php echo $_SESSION['level']; ?></div>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Administrator</li>
                        <li class="dropdown">
                            <a href="Dashboard.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link" href="user.php"><i data-feather="user"></i><span>User</span></a>
                        </li>

                        <li class="menu-header">User</li>
                        <li class="dropdown">
                            <a class="nav-link" href="karyawan.php"><i data-feather="database"></i><span>Data Karyawan</span></a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link" href="departemen.php"><i data-feather="database"></i><span>Departemen</span></a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link" href="jabatan.php"><i data-feather="database"></i><span>Jabatan</span></a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link" href="golongan.php"><i data-feather="database"></i><span>Golongan</span></a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link" href="gaji.php"><i data-feather="dollar-sign"></i><span>Gaji</span></a>
                        </li>
                        <!-- Divider -->
                        <!-- <hr class="sidebar-divider">

                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown"><i data-feather="printer"></i><span>Cetak</span></a>
                            <ul class="dropdown-menu">
                                <li class="active"><a class="nav-link" href="">Dashboard V1</a></li>
                                <li><a class="nav-link" href="index2.html">Dashboard V2</a></li>
                            </ul>
                        </li> -->
                        <!-- Divider -->
                        <hr class="sidebar-divider">

                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-fw fa-sign-out-alt"></i>
                                <span>Logout</span></a>
                        </li>
                    </ul>
                </aside>
            </div>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <!-- add content here -->
                        <h1 class="h3 mb-4 text-gray-800">Edit Profile</h1>
                        <form action="update_profile.php" method="post" class="form-user" enctype="multipart/form-data">
                            <?php
                            include 'koneksi.php';
                            $query = "SELECT * FROM user where id = $_SESSION[id]";
                            $query_run = mysqli_query($conn, $query);
                            $result = mysqli_fetch_array($query_run);

                            ?>
                            <div class="form-group">
                                <label class="control-label">Username</label>
                                <input type="hidden" name="id" value="<?php echo $result['id']; ?>" class="form-control" required>
                                <input type="text" name="username" value="<?php echo $result['username']; ?>" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <input type="email" name="email" value="<?php echo $result['email']; ?>" class="form-control" id="email" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="form-group">


                                        <label class="control-label" for="image">Upload untuk mengganti</label>
                                        <input type="file" name="image" value="" class="form-control" id="image" required>
                                    </div>
                                </div>

                                <div class="col-lg-2">

                                    <div class="form-group">
                                        <label class="control-label" for="image">Sebelumnya</label>
                                        <img src="assets/img/profile/<?php echo $result['image']; ?>" style="width: 120px;float: left;margin-bottom: 10px;">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="edit_profile.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
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