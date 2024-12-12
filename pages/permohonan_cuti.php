<?php include 'config/functions.php'; $userId = $_SESSION['pengguna']['id_user'];
$now = date('Y-m-d');
$queryCuti = querySQL("SELECT tanggal_permohonan FROM absensi_cuti WHERE user_id = '$userId' AND tanggal_permohonan = '$now'");

if(isset($_POST['permohonan_cuti'])) {
  try {
    $userId = $_SESSION['pengguna']['id_user'];
    $tanggal = date('Y-m-d');
    $keterangan = $_POST['keterangan'];
    $statusPermohonan = "Menunggu Persetujuan";

    $queryAbsensi = querySQL("INSERT INTO absensi_cuti (user_id, keterangan, tanggal_permohonan, status_permohonan) VALUES ('$userId', '$keterangan', '$tanggal', '$statusPermohonan')");
    if($queryAbsensi) {
      echo "<script>alert('Permohonan Cuti Berhasil Terkirim');location.href='index.php';</script>";
    } else {
      echo "<script>alert('Permohonan Cuti Gagal Terkirim');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Permohonan Cuti Gagal Terkirim');</script>";
  }
}
?>

<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Permohonan Cuti</h3>
    <div class="card">
      <div class="card-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="keterangan">Keterangan Cuti</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Keterangan Cuti" required></textarea>
          </div>
          <?php if (mysqli_num_rows($queryCuti) > 0) { ?>
            <div class="alert alert-warning">Anda sudah mengirimkan permohonan cuti pada hari ini</div>
          <?php } ?>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <?php if (mysqli_num_rows($queryCuti) > 0) { ?>
          <button type="submit" name="permohonan_cuti" disabled class="btn btn-primary float-right">Ajukan Cuti</button>
        <?php } else { ?>
          <button type="submit" name="permohonan_cuti" onclick="return confirm('Kirim Permohonan Cuti?')" class="btn btn-primary float-right">Ajukan Cuti</button>
        <?php } ?>
      </form>
      </div>
    </div>
  </div>
</div>