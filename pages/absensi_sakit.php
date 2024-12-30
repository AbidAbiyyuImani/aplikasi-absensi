<?php include 'config/functions.php';
$userId = $_SESSION['pengguna']['id_user']; $now = date('Y-m-d');
// CEK APAKAH JAM KERJA SUDAH DI TENTUKAN
if ($_SESSION['pengguna']['jk_id'] == null) {
  echo "<script>alertPopUp('index.php', 'error', 'Jam Kerja belum di tentukan', 'Mengalihkan ke halaman utama...');</script>";
} else {
  // CEK APAKAH SUDAH MENGIRIMKAN PERMOHONAN ATAU BELUM
  $queryAbsensiNow = querySQL("SELECT tanggal_permohonan FROM absensi_sakit WHERE user_id = '$userId' AND tanggal_permohonan = '$now'");
  $dataAbsensi = mysqli_fetch_assoc($queryAbsensiNow);

  if (isset($_POST['permohonan_sakit'])) {
    $suratSakit = upload('surat_sakit', ['jpg', 'jpeg', 'png'], 'dist/img/surat-sakit/');
    $tanggalMulai = $_POST['tanggal_mulai'];
    $tanggalSelesai = $_POST['tanggal_selesai'];
    $keterangan = $_POST['keterangan'];
  
    $queryPermohonan = querySQL("INSERT INTO absensi_sakit (user_id, surat_sakit, keterangan, tanggal_mulai, tanggal_selesai, tanggal_permohonan) VALUES ('$userId', '$suratSakit', '$keterangan', '$tanggalMulai', '$tanggalSelesai', '$now')");
    if ($queryPermohonan) {
      echo "<script>alertPopUp('?page=absensi_sakit', 'success', 'Permohonan sakit berhasil dikirim');</script>";
    } else {
      echo "<script>alertPopUp('index.php', 'error', 'Permohonan sakit gagal dikirim', 'Mengalihkan ke halaman utama...');</script>";
    }
  }
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Permohonan Sakit</h3>
    <div class="card card-outline card-primary">
      <div class="card-body my-3">
        <form id="form_absensi_sakit" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control">
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="surat_sakit">Surat Sakit</label>
            <div class="custom-file">
              <input type="file" name="surat_sakit" id="surat_sakit" class="custom-file-input">
              <label for="surat_sakit" class="custom-file-label">Pilih file</label>
            </div>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
          </div>
        </form>
        <?php if (isset($dataAbsensi)) { ?>
          <div class="alert alert-info">Hari ini sudah mengirim permohonan sakit, <a href="?page=histori&td=sakit">lihat histori permohonan sakit</a></div>
        <?php } ?>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <?php if (isset($dataAbsensi)) { ?>
          <button type="submit" disabled class="btn btn-primary">Kirim permohonan</button>
        <?php } else { ?>
          <button type="submit" form="form_absensi_sakit" name="permohonan_sakit" class="btn btn-primary">Kirim permohonan</button>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php } ?>