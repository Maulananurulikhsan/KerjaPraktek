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

  <?php
  include 'koneksi.php';

  $umur1 = $conn->query("SELECT * FROM karyawan where usia='20'");
  $umur2 = $conn->query("SELECT * FROM karyawan where usia='25'");
  $umur3 = $conn->query("SELECT * FROM karyawan where usia='30'");
  $umur4 = $conn->query("SELECT * FROM karyawan where usia='40'");

  $usia1 = mysqli_num_rows($umur1);
  $usia2 = mysqli_num_rows($umur2);
  $usia3 = mysqli_num_rows($umur3);
  $usia4 = mysqli_num_rows($umur4);

  ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Umur', 'Jumlah Usia'],
        ['20', <?php echo $usia1 ?>],
        ['25', <?php echo $usia2 ?>],
        ['30', <?php echo $usia3 ?>],
        ['40', <?php echo $usia4 ?>]
      ]);

      var options = {
        title: 'Perhitungan Jumlah Usia',
        curveType: 'function',
        legend: {
          position: 'bottom'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

      chart.draw(data, options);
    }
  </script>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <!-- header -->
      <?php include 'header.php'; ?>

      <!-- end header -->
      <!-- Start navbar -->
      <div class="main-sidebar sidebar-style-2">
        <?php include 'navbar.php'; ?>
      </div>
      <!-- end navbar -->
      <!-- Main Content -->
      <?php
      include 'koneksi.php';
      $query1 = $conn->query("SELECT * FROM karyawan");
      $query2 = $conn->query("SELECT * FROM user");
      $query3 = $conn->query("SELECT * FROM departemen");
      $query4 = $conn->query("SELECT * FROM jabatan");

      $jml_karyawan = mysqli_num_rows($query1);
      $jml_user = mysqli_num_rows($query2);
      $jml_departemen = mysqli_num_rows($query3);
      $jml_jabatan = mysqli_num_rows($query4);
      ?>
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
            <div class="row ">
              <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-green-dark">
                  <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-user"></i></div>
                    <div class="card-content">
                      <h4 class="card-title">User Account</h4>
                      <span><?php echo number_format($jml_user, 0, ",", "."); ?></span>

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-cyan-dark">
                  <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-users"></i></div>
                    <div class="card-content">
                      <h4 class="card-title">Data Karyawan</h4>
                      <span><?php echo number_format($jml_karyawan, 0, ",", "."); ?></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-purple-dark">
                  <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-warehouse"></i></div>
                    <div class="card-content">
                      <h4 class="card-title">Departemen</h4>
                      <span><?php echo number_format($jml_departemen, 0, ",", "."); ?></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-orange-dark">
                  <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-building"></i></div>
                    <div class="card-content">
                      <h4 class="card-title">Jabatan</h4>
                      <span><?php echo number_format($jml_jabatan, 0, ",", "."); ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div id="curve_chart" style="width: 100%; height: 500px"></div>
        <!-- <div id="columnchart_values" style="width: 900px; height: 300px;"></div> -->
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