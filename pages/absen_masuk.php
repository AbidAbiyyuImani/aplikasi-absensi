<?php include 'config/functions.php'; $userId = $_SESSION['pengguna']['id_user'];
$now = date('Y-m-d');
$queryAbsensiNow = querySQL("SELECT jam_masuk, tanggal_absensi FROM absensi WHERE user_id = '$userId' AND tanggal_absensi = '$now'");
$dataAbsensi = mysqli_fetch_assoc($queryAbsensiNow);

if(isset($_POST['absen_masuk'])) {
  try {
    $userId = $_SESSION['pengguna']['id_user'];
    $jamMasuk = date('H:i:s');
    $tanggal = date('Y-m-d');
    $fotoAbsen = upload('foto', ['jpg', 'jpeg', 'png'], 'dist/img/absensi/');
  
    $queryAbsensi = querySQL("INSERT INTO absensi (user_id, jam_masuk, tanggal_absensi, foto_absen) VALUES ('$userId', '$jamMasuk', '$tanggal', '$fotoAbsen')");
    if($queryAbsensi) {
      echo "<script>alert('Absen Masuk Berhasil');location.href='index.php';</script>";
    } else {
      echo "<script>alert('Absen Masuk Gagal');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Absen Masuk Gagal');</script>";
  }
}
?>

<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Absen Masuk</h3>
    <div class="card card-outline card-primary">
      <div class="card-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="foto">Foto Absen</label>
            <div class="custom-file">
              <input type="file" name="foto" id="foto" required class="custom-file-input">
              <label for="foto" class="custom-file-label">Foto Absen</label>
            </div>
          </div>
          <?php if (isset($dataAbsensi['jam_masuk'])) { ?>
            <div class="alert alert-success">Absen masuk telah dilakukan pada : <?= $dataAbsensi['jam_masuk'] ?></div>
          <?php } ?>
          <div class="alert alert-warning">Pastikan memori anda tidak penuh!</div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <?php if (mysqli_num_rows($queryAbsensiNow) > 0) { ?>
          <button type="submit" name="absen_masuk" disabled class="btn btn-primary float-right">Absen Masuk</button>
        <?php } else { ?>
          <button type="submit" name="absen_masuk" onclick="return confirm('Setelah melanjutkan, anda hanya bisa melakukan absen keluar')" class="btn btn-primary float-right">Absen Masuk</button>
        <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>