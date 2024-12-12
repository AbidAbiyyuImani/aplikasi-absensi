<?php include 'config/functions.php';

$userId = $_SESSION['pengguna']['id_user'];
$queryAbsensi = querySQL("SELECT * FROM absensi WHERE user_id = '$userId' AND jam_keluar IS NULL");
$dataAbsensi = mysqli_fetch_assoc($queryAbsensi);

if(isset($_POST['absen_keluar'])) {
  try {
    $userId = $_SESSION['pengguna']['id_user'];
    $jamKeluar = date('H:i:s');
    $tanggal = date('Y-m-d');
    $fotoAbsen = upload('foto', ['jpg', 'jpeg', 'png'], 'dist/img/absensi/');

    $queryAbsensi = querySQL("UPDATE absensi SET jam_keluar = '$jamKeluar', foto_absen_keluar = '$fotoAbsen' WHERE user_id = '$userId'");
    if($queryAbsensi) {
      echo "<script>alert('Absen Keluar Berhasil');location.href='index.php';</script>";
    } else {
      echo "<script>alert('Absen Keluar Gagal');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Absen Keluar Gagal');</script>";
  }
}
?>

<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Absen Keluar</h3>
    <div class="card">
      <div class="card-body">
        <h5 class="mb-3">Absen Masuk : <?= ($dataAbsensi !== null) ? $dataAbsensi['jam_masuk'] : 'Absen Masuk Terlebih Dahulu' ?></h5>
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="foto">Foto Absen</label>
            <div class="custom-file">
              <input type="file" name="foto" id="foto" required class="custom-file-input">
              <label for="foto" class="custom-file-label">Foto Absen</label>
            </div>
          </div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <button type="submit" name="absen_keluar" class="btn btn-primary float-right">Absen Keluar</button>
      </form>
      </div>
    </div>
  </div>
</div>