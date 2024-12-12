<?php include 'config/functions.php';

if(isset($_POST['absen_sakit'])) {
  try {
    $userId = $_SESSION['pengguna']['id_user'];
    $tanggal = date('Y-m-d');
    $suratSakit = upload('foto', ['jpg', 'jpeg', 'png'], 'dist/img/surat/');
    $statusPermohonan = "Menunggu Persetujuan";

    $queryAbsensi = querySQL("INSERT INTO absensi_sakit (user_id, tanggal_permohonan, surat_sakit, status_permohonan) VALUES ('$userId', '$tanggal', '$suratSakit', '$statusPermohonan')");
    if($queryAbsensi) {
      echo "<script>alert('Permohonan Sakit Berhasil Terkirim');location.href='index.php';</script>";
    } else {
      echo "<script>alert('Permohonan Sakit Gagal Terkirim');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Permohonan Sakit Gagal Terkirim');</script>";
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
            <label for="foto">Foto Surat Keterangan Sakit</label>
            <div class="custom-file">
              <input type="file" name="foto" id="foto" required class="custom-file-input">
              <label for="foto" class="custom-file-label">Surat Keterangan Sakit</label>
            </div>
          </div>
          <a href="index.php" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="absen_sakit" onclick="return confirm('Kirim Permohonan Izin Sakit?')" class="btn btn-primary float-right">Absen Sakit</button>
        </form>
      </div>
    </div>
  </div>
</div>