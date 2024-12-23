<?php include 'config/database_connection.php'; include 'config/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE App -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Sweetalert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card">
      <div class="card-body login-card-body">
        <form method="post">
          <h3 class="text-center mb-3">Login</h3>
          <div class="form-group">
            <input type="text" name="username" id="username" placeholder="Username" required autofocus class="form-control">
          </div>
          <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Password" required class="form-control">
          </div>
          <button type="submit" name="login" class="btn btn-primary">Login</button>
          <a href="register.php" class="d-block mt-2">Belum mempunyai akun? register sekarang!</a>
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
  <script>
    if(window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>
</html>
<?php if (isset($_SESSION['pengguna'])) {
  echo "<script>alertPopUp('index.php', 'error', 'Anda sudah login', 'Mengalihkan ke halaman utama...');</script>";
}

if (isset($_POST['login'])) {
  try {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $querySelect = querySQL("SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($querySelect) > 0) {
      $result = mysqli_fetch_assoc($querySelect);
      if ($result['password'] === $password) {
        $_SESSION['pengguna'] = $result;
        echo "<script>alertPopUp('index.php', 'success', 'Berhasil login', 'Mengalihkan ke halaman utama...');</script>";
      } else {
        echo "<script>toastr.warning('Password yang anda masukan tidak sesuai!');</script>";
      }
    } else {
      echo "<script>toastr.error('Akun tidak berhasil ditemukan!');</script>";
    }
  } catch (Exception $e) {
    echo "<script>toastr.error('Tidak dapat login!');</script>";
  }
}
?>