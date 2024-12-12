<?php date_default_timezone_set('Asia/Jakarta'); include 'config/database_connection.php'; if(!isset($_SESSION['pengguna'])) {
  echo "<script>alert('Login terlebih dahulu');location.href='login.php';</script>";
}
$level = $_SESSION['pengguna']['level'];
switch ($level) {
  case "Super Admin":
  case "Admin":
?>
<!-- Tampilan halaman Super Admin dan Admin -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Absensi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="?page=about" class="nav-link">About</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item  dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img style="object-fit: cover;" src="dist/img/avatar/<?= $_SESSION['pengguna']['foto'] ?>" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?= $_SESSION['pengguna']['nama_lengkap'] ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <li class="nav-item"><a href="?page=profile" class="nav-link">Profile</a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link text-center">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-medium">Absensi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <?php switch ($level) {
            case "Super Admin":
              case "Admin":
          ?>
            <li class="nav-item">
              <a href="?page=data_karyawan" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Karyawan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=data_divisi" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Divisi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=data_jam" class="nav-link">
                <i class="nav-icon fas fa-clock"></i>
                <p>Jam Kerja</p>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
                <i class="nav-icon fas fa-address-book"></i>
                <p>
                  Manajemen Absensi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?page=data_absensi" class="nav-link">
                    <p>Absensi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?page=data_izin" class="nav-link">
                    <p>Izin Sakit</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?page=data_cuti" class="nav-link">
                    <p>Cuti</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Laporan
                  <i class="right fas fa-angle-left"></i>
                </p>
                
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?page=data_absensi" class="nav-link">
                    <p>Laporan Absensi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?page=data_absensi_sakit" class="nav-link">
                    <p>Laporan Bukti Sakit</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php break; case "User": ?>
            <li class="nav-item">
              <a href="?page=absensi" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>Absensi</p>
              </a>
            </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper py-2">
    <!-- Main content -->
    <?php $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; ?>
    <section class="content">
      <div class="container-fluid">
        <?php if ($page == 'login' || $page == 'register') {
          include '404.php'; 
          } else if (file_exists("./pages/$page.php")) {
            include "./pages/$page.php";
          } else {
            include '404.php';
          }
        ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="#">Abid Abiyyu Imani</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Login as</b> <?= $level ?>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- bs-custom-file-input -->
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.js"></script>
  <script>
  $(function () {
    bsCustomFileInput.init();
  });
  </script>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script></script>
  <script>
    $(function () {
      $(".table-data").dataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <script>
    if(window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>
</html>
<?php break; case "User": ?>
<!-- Tampilan halaman user -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Absensi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-medium d-none d-md-inline">Absensi</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a id="absenDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Absensi</a>
            <ul aria-labelledby="absenDropdown" class="dropdown-menu border-0 shadow">
              <li><a href="?page=cuti" class="dropdown-item">Cuti</a></li>
              <li><a href="?page=izin" class="dropdown-item">Izin Sakit</a></li>
              <li><a href="?page=histori" class="dropdown-item">Histori Absensi</a></li>
            </ul>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item  dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img style="object-fit: cover;" src="dist/img/avatar/<?= $_SESSION['pengguna']['foto'] ?>" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"><?= $_SESSION['pengguna']['nama_lengkap'] ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <li class="nav-item"><a href="?page=profile" class="nav-link">Profile</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <?php $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; ?>
  <div class="content-wrapper py-2">
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <?php if ($page == 'login' || $page == 'register') {
          include '404.php'; 
          } else if (file_exists("./pages/$page.php")) {
            include "./pages/$page.php";
          } else {
            include '404.php';
          }
        ?>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <b>Login as</b> <?= $level ?>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2024 <a href="#">Abid Abiyyu Imani</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

   <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- bs-custom-file-input -->
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.js"></script>
  <script>
  $(function () {
    bsCustomFileInput.init();
  });
  </script>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script></script>
  <script>
    $(function () {
      $(".table-data").dataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <script>
    if(window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>
</html>


<?php break; } ?>