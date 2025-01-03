<?php include 'config/database_connection.php'; include 'config/functions.php';
if (isset($_SESSION['pengguna'])) {
  $level = $_SESSION['pengguna']['level'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE App -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Sweeralert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
</head>
<body class="hold-transition register-page">
  <div class="register-box min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card">
      <div class="card-body register-card-body">
        <form method="post" enctype="multipart/form-data">
          <h3 class="text-center mb-3">Register</h3>
          <div class="form-group">
            <input type="text" name="namaLengkap" id="namaLengkap" placeholder="Nama Lengkap" required class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="username" id="username" placeholder="Username" required class="form-control">
          </div>
          <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Email" required class="form-control">
          </div>
          <div class="form-group">
            <div class="custom-file">
              <input type="file" name="foto" id="foto" required class="custom-file-input">
              <label for="foto" class="custom-file-label">Foto Profil</label>
            </div>
          </div>
          <?php if (isset($level)) { ?>
            <div class="form-group">
              <select name="level" id="level" class="form-control">
                <option>Pilih Level</option>
                <?php $level = ['Admin', 'Karyawan'];
                  foreach ($level as $data) { ?>
                  <option value="<?= $data ?>"><?= $data ?></option>
                <?php } ?>
              </select>
            </div>
          <?php } ?>
          <div class="form-group">
            <input type="password" name="password" placeholder="Password" required id="password" class="form-control">
          </div>
          <?php if (!isset($level)) { ?>
            <button type="submit" name="register" class="btn btn-primary">Register</button>
          <?php } else { ?>
            <a href="index.php?page=data_karyawan" class="btn btn-secondary">Kembali</a>
            <button type="submit" name="register" class="btn btn-primary float-right">Register</button>
          <?php } ?>
          <a href="login.php" class="d-block mt-2">Sudah mempunyai akun? login sekarang!</a>
        </form>
      </div>
    </div>  
  </div>

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Toastr -->
  <script src="plugins/toastr/toastr.min.js"></script>
  <script src="dist/js/toastr-options.js"></script>
  <!-- Sweetalert2 -->
  <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.js"></script>
  <!-- Functions -->
  <script src="config/functions.js"></script>
  <!-- bs-custom-file-input -->
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.js"></script>
  <script>
  $(function () {
    bsCustomFileInput.init();
  });
  </script>
  <script>
    if(window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>
</html>
<?php 
if (isset($_POST['register'])) {
  try {
    $namaLengkap = $_POST['namaLengkap'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    if (isset($level)) {
      $level = $_POST['level'];
    } else {
      $level = 'Karyawan';
    }
    $foto = upload('foto', ['jpg', 'jpeg', 'png'], 'dist/img/avatar/');
    $password = md5($_POST['password']);

    $queryInsert = querySQL("INSERT INTO users (nama_lengkap, username, email, level, foto, password) VALUES ('$namaLengkap', '$username', '$email', '$level', '$foto', '$password')");
    if ($queryInsert) {
      if ($_SESSION['pengguna']['level'] === 'Admin') {
        echo "<script>alertPopUp('index.php?page=data_karyawan', 'success', 'Berhasil register', 'Mengalihkan ke halaman data karyawan...');</script>";
      } else {
        echo "<script>alertPopUp('login.php', 'success', 'Berhasil register', 'Mengalihkan ke halaman login...');</script>";
      }
    } else {
      echo "<script>toastr.error('Gagal register!');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alertPopUp(null, 'warning', 'Username sudah terdaftar', 'Login untuk masuk ke aplikasi');</script>";
  }
}
?>