<?php include 'config/functions.php'; $userId = $_SESSION['pengguna']['id_user'];
$now = date('Y-m-d');
$queryIzinSakit = querySQL("SELECT tanggal_permohonan FROM absensi_sakit WHERE user_id = '$userId' AND tanggal_permohonan = '$now'");

if(isset($_POST['absen_sakit'])) {
  try {
    $userId = $_SESSION['pengguna']['id_user'];
    $tanggal = date('Y-m-d');
    $suratSakit = upload('suratKet', ['jpg', 'jpeg', 'png'], 'dist/img/surat/');
    $statusPermohonan = "Menunggu Persetujuan";

    $queryAbsensi = querySQL("INSERT INTO absensi_sakit (user_id, tanggal_permohonan, surat_sakit, status_permohonan) VALUES ('$userId', '$tanggal', '$suratSakit', '$statusPermohonan')");
    if($queryAbsensi) {
      echo "<script>alert('Absen Sakit Berhasil Terkirim');location.href='index.php';</script>";
    } else {
      echo "<script>alert('Absen Sakit Gagal Terkirim');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Absen Sakit Gagal Terkirim');</script>";
  }
}

?>

<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Absen Sakit</h3>
    <div class="card">
      <div class="card-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="suratKet">Surat Keterangan Sakit</label>
            <div class="custom-file">
              <input type="file" name="suratKet" id="suratKet" required class="custom-file-input">
              <label for="suratKet" class="custom-file-label">Surat Keterangan Sakit</label>
            </div>
          </div>
        </form>
        <?php if (mysqli_num_rows($queryIzinSakit) > 0) { ?>
          <div class="alert alert-warning">Anda sudah mengirimkan permohonan izin sakit pada hari ini</div>
        <?php } ?>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <?php if (mysqli_num_rows($queryIzinSakit) > 0) { ?>
          <button type="submit" name="absen_sakit" disabled class="btn btn-primary float-right">Absen Sakit</button>
        <?php } else { ?>
          <button type="submit" name="absen_sakit" onclick="return confirm('Kirim Permohonan Izin Sakit?')" class="btn btn-primary float-right">Absen Sakit</button>
        <?php } ?> 
      </div>
    </div>
  </div>
</div>