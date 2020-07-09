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
                        <h1 class="h3 mb-4 text-gray-800">Karyawan</h1>
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <?php
                                    $conn = mysqli_connect('localhost', 'root', '', 'project');

                                    $query = "SELECT * FROM karyawan";
                                    $query_run = mysqli_query($conn, $query);
                                    ?>
                                    <table class="table table-striped table-responsive" id="table-1">
                                        <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">NIK</th>
                                                <th class="text-center">Nama Karyawan</th>
                                                <th class="text-center">Usia</th>
                                                <th class="text-center">Nama Golongan</th>
                                                <th class="text-center">Tanggal Masuk</th>
                                                <th class="text-center">Nomor Telepon</th>
                                                <th class="text-center">Alamat</th>
                                                <th class="text-center">Departemen</th>
                                                <th class="text-center">Jabatan</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Jumlah Anak</th>
                                                <th class="text-center">Masa Kerja</th>
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
                                                        <td class="text-center"><?php echo $d['nik']; ?></td>
                                                        <td class="text-center"><?php echo $d['nama_karyawan']; ?></td>
                                                        <td class="text-center"><?php echo $d['usia']; ?></td>
                                                        <td class="text-center"><?php echo $d['nama_golongan']; ?></td>
                                                        <td class="text-center"><?php echo date_format(date_create($d['tanggal_masuk']), 'd') . ' ' . bulan(date_format(date_create($d['tanggal_masuk']), 'm')) . ' ' . date_format(date_create($d['tanggal_masuk']), 'Y') . ' '; ?></td>
                                                        <td class="text-center"><?php echo $d['nomor_telepon']; ?></td>
                                                        <td class="text-center"><?php echo $d['alamat']; ?></td>
                                                        <td class="text-center"><?php echo $d['departemen']; ?></td>
                                                        <td class="text-center"><?php echo $d['jabatan']; ?></td>
                                                        <td class="text-center"><?php echo $d['status']; ?></td>
                                                        <td class="text-center"><?php echo $d['jumlah_anak']; ?></td>
                                                        <td class="text-center"><?php //echo $d['masa_kerja'];
                                                                                $since = date_format(date_create($d['tanggal_masuk']), 'Y');
                                                                                $now = date("Y");
                                                                                if (($now - $since) == 0) {
                                                                                    $mon = date_format(date_create($d['tanggal_masuk']), 'm');
                                                                                    $bulanni = date("m");
                                                                                    if (($bulanni - $mon) == 0) {
                                                                                        $daysince = date_format(date_create($d['tanggal_masuk']), 'd');
                                                                                        $tudey = date("d");
                                                                                        echo $tudey - $daysince . " hari";
                                                                                    } else {

                                                                                        echo $bulanni - $mon . " bulan";
                                                                                    }
                                                                                } else {

                                                                                    echo $now - $since . " tahun";
                                                                                }
                                                                                ?></td>
                                                        <td align="center">
                                                            <a href="edit_data.php?id=<?php echo $d['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                                            <a href="delete.php?id=<?php echo $d['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>Delete</a>
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
                                                <div class="px-3">
                                                    <a href="laporan/cetak.php" target="_blank" class="btn btn-info btn-md"><i class="fa fa-print"></i> Cetak</a>
                                                    <a href="laporan/exportexcel.php" target="_blank" class="btn btn-default btn-md"><i class="fa fa-print"></i> Export Excel</a>
                                                    <hr class="sidebar-divider">
                                                </div>

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
                    <h5 class="modal-title" id="staticBackdropLabel">Data Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="insertcode.php" method="post" class="form-user" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="nik">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="nama_karyawan">Nama Karyawan</label>
                            <input type="text" name="nama_karyawan" class="form-control" id="nama_karyawan" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="usia">Usia</label>
                            <input type="number" name="usia" class="form-control" id="usia" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="golongan">Golongan</label>
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
                            <input type="date" name="tanggal_masuk" class="form-control" id="tanggal_masuk" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="nomor_telepon">Nomor Telepon</label>
                            <input type="number" name="nomor_telepon" class="form-control" id="nomor_telepon" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="alamat">Alamat</label>
                            <input type="alamat" name="alamat" class="form-control" id="alamat" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="departemen">Departemen</label>
                            <select name="departemen" id="departemen" class="form-control" required>
                                <option value=""> --- Pilih Departemen --- </option>
                                <?php
                                $query = mysqli_query($conn, "select * from departemen");
                                while ($d = mysqli_fetch_array($query)) {
                                ?>

                                    <option value="<?php echo $d['departemen']; ?>"><?php echo $d['id_dept']; ?> - <?php echo $d['departemen']; ?></option>
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
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value=""> --- Pilih Status --- </option>
                                <?php
                                $query = mysqli_query($conn, "select * from status");
                                while ($d = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $d['status']; ?>"><?php echo $d['status']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="jumlah_anak">Jumlah Anak</label>
                            <input type="text" name="jumlah_anak" class="form-control" id="jumlah_anak" required>
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
<?php
function bulan($bln)
{
    if ($bln == 1) {
        $bulan1 = "Januari";
    } elseif ($bln == 2) {
        $bulan1 = "Februari";
    } elseif ($bln == 3) {
        $bulan1 = "Maret";
    } elseif ($bln == 4) {
        $bulan1 = "April";
    } elseif ($bln == 5) {
        $bulan1 = "Mei";
    } elseif ($bln == 6) {
        $bulan1 = "Juni";
    } elseif ($bln == 7) {
        $bulan1 = "Juli";
    } elseif ($bln == 8) {
        $bulan1 = "Agustus";
    } elseif ($bln == 9) {
        $bulan1 = "September";
    } elseif ($bln == 10) {
        $bulan1 = "Oktober";
    } elseif ($bln == 11) {
        $bulan1 = "November";
    } elseif ($bln == 12) {
        $bulan1 = "Desember";
    }
    return $bulan1;
}
?>