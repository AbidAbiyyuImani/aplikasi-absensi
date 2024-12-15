<?php include 'config/database_connection.php'; include 'config/functions.php';
if (!isset($_GET['trid'])) {
  $querySA = querySQL("SELECT level FROM users WHERE level = 'Super Admin'");
  if (mysqli_num_rows($querySA) == 1 || mysqli_num_rows($querySA) !== 0) {
    echo "<script>alert('Halaman register tidak dapat diakses!');location.href='login.php';</script>";
  }
}

if (isset($_POST['register'])) {
  try {
    $namaLengkap = $_POST['namaLengkap'];
    $username = $_POST['username'];
    $level = $_POST['level'];
    $password = md5($_POST['password']);
  
    $queryInsert = querySQL("INSERT INTO users (nama_lengkap, username, level, password) VALUES ('$namaLengkap', '$username','$level', '$password')");
    if ($queryInsert) {
      if (isset($_GET['trid'])) {
        echo "<script>alert('Berhasil menambahkan akun!');location.href='index.php?page=data_karyawan'</script>";
      }
      echo "<script>alert('Berhasil mendaftarkan akun!');location.href='login.php'</script>";
    } else {
      echo "<script>alert('Gagal menambahkan akun!')</script>";
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
  <title>Register</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE App -->
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
          <?php if (isset($_GET['trid']) == md5('Super Admin')) { ?>
            <div class="form-group">
              <select name="level" id="level" name="level" class="form-control">
                <option selected disabled>Pilih level</option>
                <?php
                  $level = ['Admin', 'User'];
                  foreach ($level as $l) {
                ?>
                  <option value="<?= $l ?>"><?= $l ?></option>
                <?php } ?>
              </select>
            </div>
          <?php } else { ?>
            <input type="hidden" name="level" value="Super Admin">
          <?php } ?>
          <div class="form-group">
            <input type="password" name="password" placeholder="Password" required id="password" class="form-control">
          </div>
          <button type="submit" name="register" class="btn btn-primary mb-2">Register</button>
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