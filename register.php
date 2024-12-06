<?php include 'config/database_connection.php'; include 'config/functions.php';
if(isset($_POST['register'])) {
  $namaLengkap = $_POST['namaLengkap'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $level = 'User';
  $foto = upload('foto', ['jpg', 'jpeg', 'png'], 'dist/img/avatar/');
  $password = md5($_POST['password']);

  $queryInsert = querySQL("INSERT INTO users (nama_lengkap, username, email, level, foto, password) VALUES ('$namaLengkap', '$username', '$email', '$level', '$foto', '$password')");
  if($queryInsert) {
    echo "<script>alert('Berhasil register!');location.href='login.php'</script>";
  } else {
    echo "<script>alert('Gagal register!')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card">
      <div class="card-body">
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
          <div class="form-group">
            <input type="password" name="password" placeholder="Password" required id="password" class="form-control">
          </div>
          <button type="submit" name="register" class="btn btn-primary mb-2">Register</button>
          <a href="login.php" class="d-block">Sudah mempunyai akun? login sekarang!</a>
        </form>
      </div>
    </div>  
  </div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- adminLTE App -->
<script src="dist/css/adminlte.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>