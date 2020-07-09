<?php
session_start();
error_reporting(0);
include 'koneksi.php';
include 'fungsi.php';
if (isset($_POST['gajian'])) {
    mysqli_query($conn, "INSERT INTO master_gaji values(null,'" . $_POST['NIK'] . "','" . $_POST['tanggal'] . "','" . $_POST['lembur'] . "','" . $_POST['potongan'] . "')");
}
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
                        <div class="row">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Gaji Pegawai</h3>
                                    <span class="pull-right">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahgaji">
                                            Masukan Master Gaji
                                        </button>
                                    </span>
                                </div>
                                <div class="panel-body">
                                    <form action="" class="form-inline" method="get">
                                        <div class="form-group">
                                            <label>Bulan</label>
                                            <select name="bulan" id="" class="form-control">
                                                <option value="">- Pilih -</option>
                                                <option value="01" <?php if ($_GET['bulan'] == '01') :  echo 'selected';
                                                                    endif; ?>>Januari</option>
                                                <option value="02" <?php if ($_GET['bulan'] == '02') :  echo 'selected';
                                                                    endif; ?>>Februari</option>
                                                <option value="03" <?php if ($_GET['bulan'] == '03') :  echo 'selected';
                                                                    endif; ?>>Maret</option>
                                                <option value="04" <?php if ($_GET['bulan'] == '04') :  echo 'selected';
                                                                    endif; ?>>April</option>
                                                <option value="05" <?php if ($_GET['bulan'] == '05') :  echo 'selected';
                                                                    endif; ?>>Mei</option>
                                                <option value="06" <?php if ($_GET['bulan'] == '06') :  echo 'selected';
                                                                    endif; ?>>Juni</option>
                                                <option value="07" <?php if ($_GET['bulan'] == '07') :  echo 'selected';
                                                                    endif; ?>>Juli</option>
                                                <option value="08" <?php if ($_GET['bulan'] == '08') :  echo 'selected';
                                                                    endif; ?>>Agustus</option>
                                                <option value="09" <?php if ($_GET['bulan'] == '09') :  echo 'selected';
                                                                    endif; ?>>September</option>
                                                <option value="10" <?php if ($_GET['bulan'] == '10') :  echo 'selected';
                                                                    endif; ?>>Oktober</option>
                                                <option value="11" <?php if ($_GET['bulan'] == '11') :  echo 'selected';
                                                                    endif; ?>>November</option>
                                                <option value="12" <?php if ($_GET['bulan'] == '12') :  echo 'selected';
                                                                    endif; ?>>Desember</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <select name="tahun" id="" class="form-control">
                                                <option value="">- Pilih -</option>
                                                <?php
                                                $y = date('Y');
                                                for ($i = 2018; $i <= $y; $i++) {
                                                    echo "<option value='$i'";
                                                    if (isset($_GET['tahun'])) {
                                                        if ($_GET['tahun'] == $i) :
                                                            echo "selected";
                                                        endif;
                                                    }
                                                    echo ">$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tampil berdasarkan Bulan Dan Tahun</button>
                                        <!-- <div class="form-control"> -->
                                        &nbsp; atau &nbsp;
                                        <a href="gaji.php" class="btn btn-link">tampilkan semua</a>
                                        <!-- </div> -->

                                    </form>
                                    <br>
                                    <?php
                                    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
                                        $bulan = $_GET['bulan'];
                                        $tahun = $_GET['tahun'];
                                        $bulantahun = $tahun . '-' . $bulan; ?>

                                        <div class="alert alert-info">
                                            <strong>Filter Bulan <?php echo bulan($bulan); ?> <?php echo $tahun; ?></strong>
                                        </div>
                                    <?php
                                    } else {
                                        $bulan = date('m');
                                        $tahun = date('Y');
                                        $bulantahun = $tahun . '-' . $bulan;
                                    }
                                    ?>

                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <!-- <table class="table table-bordered table-striped"> -->
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>NIK</th>
                                                    <th>Nama Karyawan</th>
                                                    <th>Jabatan</th>
                                                    <th>Gol</th>
                                                    <th>Status</th>
                                                    <th>Jumlah Anak</th>
                                                    <th>Gapok</th>
                                                    <th>Tj. Jabatan</th>
                                                    <th>Tj.S/I</th>
                                                    <th>Tj. Anak</th>
                                                    <th>Uang Makan</th>
                                                    <th>Uang Lembur</th>
                                                    <th>Askes</th>
                                                    <th>Pendapatan</th>
                                                    <th>Potongan</th>
                                                    <th>Total Gaji</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // $sql = mysqli_query($conn, "SELECT * karyawan.nik,karyawan.nama_karyawan,jabatan.jabatan,golongan.nama_golongan,karyawan.status,karyawan.jumlah_anak,
                                                // jabatan.gapok,jabatan.tunjangan,
                                                // IF(karyawan.status='Menikah',tunjangan_suami_istri,0) AS tjsi,
                                                // IF(karyawan.status='Menikah',tunjangan_anak,0) AS tjanak,uang_makan AS uangmakan,
                                                // master_gaji.lembur*uang_lembur AS uanglembur,askes,
                                                // (gapok+tunjangan+(SELECT * tjsi)+(SELECT * tjanak)+(SELECT * uangmakan)+(SELECT * uanglembur)+askes) AS pendapatan,potongan,
                                                // (SELECT * pendapatan) - potongan AS totalgaji
                                                // FROM karyawan
                                                // INNER JOIN master_gaji ON master_gaji.nik=karyawan.nik
                                                // INNER JOIN golongan ON golongan.nama_golongan=karyawan.nama_golongan
                                                // INNER JOIN jabatan ON jabatan.jabatan=karyawan.jabatan
                                                // WHERE master_gaji.bulan='$bulantahun'
                                                // ORDER BY karyawan.nik ASC");
                                                if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
                                                    //     $sql = mysqli_query($conn, "SELECT *
                                                    // FROM karyawan
                                                    // INNER JOIN master_gaji ON master_gaji.nik=karyawan.nik
                                                    // INNER JOIN golongan ON golongan.nama_golongan=karyawan.nama_golongan
                                                    // INNER JOIN jabatan ON jabatan.jabatan=karyawan.jabatan
                                                    // WHERE karyawan.tanggal_masuk like '$bulantahun%'
                                                    // ORDER BY karyawan.nik ASC");
                                                    $sql = mysqli_query($conn, "SELECT *
                                                FROM  master_gaji where bulan like '$bulantahun%'
                                                ORDER BY bulan desc ");
                                                } else {
                                                    //     $sql = mysqli_query($conn, "SELECT *
                                                    // FROM karyawan
                                                    // INNER JOIN master_gaji ON master_gaji.nik=karyawan.nik
                                                    // INNER JOIN golongan ON golongan.nama_golongan=karyawan.nama_golongan
                                                    // INNER JOIN jabatan ON jabatan.jabatan=karyawan.jabatan
                                                    // ORDER BY karyawan.nik ASC");
                                                    $sql = mysqli_query($conn, "SELECT *
                                                FROM  master_gaji
                                                ORDER BY bulan desc ");
                                                }


                                                $no = 1;

                                                while ($g = mysqli_fetch_array($sql)) {
                                                    $karyawannya = "SELECT *
                                                    FROM karyawan
                                                    INNER JOIN master_gaji ON master_gaji.nik=karyawan.nik
                                                    INNER JOIN golongan ON golongan.nama_golongan=karyawan.nama_golongan
                                                    INNER JOIN jabatan ON jabatan.jabatan=karyawan.jabatan
                                                    where karyawan.nik='" . $g["nik"] . "'";
                                                    // echo $karyawannya . "<br>";
                                                    $d = mysqli_fetch_array(mysqli_query($conn, $karyawannya));
                                                    if ($d['status'] == 'Menikah') {
                                                        $status = 'Menikah';
                                                        $tjsi = $d['tunjangan_suami_istri'];
                                                        $tja = $d['tunjangan_anak'] * $d['jumlah_anak'];
                                                        $lembur = $d['uang_lembur'] * $g['lembur'];
                                                        // $income = $d['pendapatan'];
                                                        $income = $d['gapok'] + $d['tunjangan'] + $tjsi + $tja + $d['uang_makan'] + $lembur + $d['askes'];
                                                        $sum = $income - $d['potongan'];
                                                    } else {
                                                        $status = 'Belum Menikah';

                                                        $tjsi = 0;
                                                        $tja = 0;

                                                        $lembur = $d['uang_lembur'] * $d['lembur'];
                                                        // $income = $d['pendapatan'];
                                                        $income = $d['gapok'] + $d['tunjangan'] + $d['uang_makan'] + $lembur + $d['askes'];
                                                        $sum = $income - $d['potongan'];
                                                    }
                                                    echo "<tr>
                                                    <td width='40px' align='center'>$no</td>
                                                    <td>$d[nik]</td>
                                                    <td>$d[nama_karyawan]</td>
                                                    <td>$d[jabatan]</td>
                                                    <td>$d[nama_golongan]</td>
                                                    <td>$status</td>
                                                    <td>$d[jumlah_anak]</td>
                                                    <td>" . buatRp($d['gapok']) . "</td>
                                                    <td>" . buatRp($d['tunjangan']) . "</td>
                                                    <td>" . buatRp($tjsi) . "</td>
                                                    <td>" . buatRp($tja) . "</td>
                                                    <td>" . buatRp($d['uang_makan']) . "</td>
                                                    <td>" . buatRp($lembur) . "</td>
                                                    <td>" . buatRp($d['askes']) . "</td>
                                                    <td>" . buatRp($income) . "</td>
                                                    <td>" . buatRp($d['potongan']) . "</td>
                                                    <td>" . buatRp($sum) . "</td>
                                                    <td>
                                                    <a class='btn btn-default' href='invoice.php?id=" . $g['id_master_gaji'] . "' target='_blank'><i class='fa fa-print'></i></a>
                                                    <a class='btn btn-default' href='delete_gaji.php?id=" . $g['id_master_gaji'] . "' ><i class='fa fa-trash'></i></a>
                                                    </td>
                                                    
                                                </tr>";
                                                    $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <di class="panel-footer">
                                    <?php
                                    if (mysqli_num_rows($sql) > 0) {
                                        echo "
                                        <center>
                                            <a class='btn btn-success' href='laporan/cetak_gaji.php?bulan=$bulan&tahun=$tahun' target='_blank'><span class='glypicon glypicon-print'></span> Cetak Gaji</a>
                                        </center>
                                        ";
                                    }
                                    ?>
                                </di>
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


    <!-- Modal -->
    <div class="modal fade" id="tambahgaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Master Gaji</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Karyawan</label>
                            <select name="NIK" class="form-control" id="" required>
                                <option selected disabled>-- Pilih Karyawan --</option>
                                <?php $karyawan = mysqli_query($conn, "SELECT * from karyawan order by nama_karyawan");
                                while ($k = mysqli_fetch_array($karyawan)) {
                                    echo "<option value='$k[nik]'>$k[nama_karyawan]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jam Lembur</label>
                            <input type="number" class="form-control" name="lembur" required>
                        </div>
                        <div class="form-group">
                            <label for="">Potongan (Rupiah)</label>
                            <input type="number" class="form-control" name="potongan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="gajian" class="btn btn-primary">Simpan Data</button>
                    </div>

                </form>
            </div>
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