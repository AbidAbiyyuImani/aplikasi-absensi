<?php 
include 'config/database_connection.php';
if(isset($_POST['register'])) {
  $nik = $_POST['nik'];
  $namaLengkap = $_POST['namaLengkap'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $level = 'User';
  $password = md5($_POST['password']);

  $sqlInsert = "INSERT INTO users (nik, nama_lengkap, username, email, level, password) VALUES ('$nik', '$namaLengkap', '$username', '$email', '$level', '$password')";
  $queryInsert = mysqli_query($db, $sqlInsert);
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
        <form method="post">
          <h3 class="text-center mb-3">Register</h3>
          <div class="form-group">
            <input type="text" name="nik" id="nik" placeholder="NIK" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="namaLengkap" id="namaLengkap" placeholder="Nama Lengkap" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="username" id="username" placeholder="Username" class="form-control">
          </div>
          <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Email" class="form-control">
          </div>
          <div class="form-group">
            <input type="password" name="password" placeholder="Password" id="password" class="form-control">
          </div>
          <button type="submit" name="register" class="btn btn-primary mb-2">Register</button>
          <a href="login.php" class="d-block">Sudah mempunyai akun? login sekarang!</a>
        </form>
      </div>
    </div>  
  </div>
  
  <script src="dist/css/adminlte.min.js"></script>
</body>
</html>