<?php include 'config/database_connection.php'; include 'config/functions.php';
$querySA = querySQL("SELECT level FROM users WHERE level = 'Super Admin'");
if (mysqli_num_rows($querySA) < 1 || mysqli_num_rows($querySA) == 0) {
  echo "<script>alert('Daftarkan akun anda terlebih dahulu!');location.href='register.php'</script>";
} else if (isset($_SESSION['pengguna'])) {
  echo "<script>alert('Anda sudah login!');location.href='index.php';</script>";
}

if(isset($_POST['login'])) {
  try {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $querySelect = querySQL("SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($querySelect) > 0) {
      $result = mysqli_fetch_assoc($querySelect);
      if ($result['password'] === $password) {
        $_SESSION['pengguna'] = $result;
        header("Location: index.php");
      } else {
        echo "<script>alert('Password yang anda masukan tidak sesuai!');</script>";
      }
    } else {
      echo "<script>alert('Akun tidak berhasil ditemukan!');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Tidak dapat login!');</script>";
  }
}
?>

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
</head>
<body class="hold-transition login-page">
  <div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card">
      <div class="login-card-body">
        <form method="post">
          <h3 class="text-center mb-3">Login</h3>
          <div class="alert alert-warning">
            Pastikan akun terdaftar dalam aplikasi!
          </div>
          <div class="form-group">
            <input type="text" name="username" id="username" placeholder="Username" required autofocus class="form-control">
          </div>
          <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Password" required class="form-control">
          </div>
          <button type="submit" name="login" class="btn btn-primary mb-2">Login</button>
        </form>
      </div>
    </div>
  </div>
  
  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/css/adminlte.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.js"></script>
  <script>
    if(window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>
</html>