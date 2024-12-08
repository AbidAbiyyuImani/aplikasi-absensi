<?php include 'config/database_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.all.css">
</head>
<body class="hold-transition login-page">
  <div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card">
      <div class="login-card-body">
        <form method="post">
          <h3 class="text-center mb-3">Login</h3>
          <div class="form-group">
            <input type="text" name="username" id="username" placeholder="Username" required autofocus class="form-control">
          </div>
          <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Password" required class="form-control">
          </div>
          <button type="submit" name="login" class="btn btn-primary mb-2">Login</button>
          <a href="register.php" class="d-block">Belum mempunyai akun? register sekarang!</a>
        </form>
      </div>
    </div>
  </div>
  
  <script src="dist/css/adminlte.min.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.all.js"></script>
  <script>
    import Swal from 'plugins/sweetalert2/sweetalert2.all.js';
  </script>
</body>
</html>

<?php
if(isset($_SESSION['pengguna'])) {
  echo "<script>alert('Anda sudah login!');location.href='index.php';</script>";
}

if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $sqlSelect = "SELECT * FROM users WHERE username = '$username'";
  $querySelect = mysqli_query($db, $sqlSelect);

  if(mysqli_num_rows($querySelect) > 0) {
    $result = mysqli_fetch_assoc($querySelect);
    if($result['password'] === $password) {
      $_SESSION['pengguna'] = $result;
      header("Location: index.php");
    } else {
      // echo "<script>alert('Password yang anda masukan tidak sesuai!');</script>";
      echo '
      <script>
        Swal.fire({
          title: "Password yang anda masukan salah!",
          text: "Silahkan masukan password yang sesuai",
          icon: "error"
        });
      </script>
      ';
    }
  } else {
    // echo "<script>alert('Akun tidak berhasil ditemukan!');</script>";
    echo '
    <script>
      Swal.fire({
        title: "Akun tidak ditemukan!",
        text: "Silahkan register terlebih dahulu",
        icon: "error"
      });
    </script>
    ';
  }
}
?>