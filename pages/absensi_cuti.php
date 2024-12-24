<?php include 'config/functions.php';
$userId = $_SESSION['pengguna']['id_user']; $now = date('Y-m-d');
// CEK APAKAH JAM KERJA SUDAH DI TENTUKAN
if ($_SESSION['pengguna']['jk_id'] == null) {
  echo "<script>alertPopUp('index.php', 'error', 'Jam Kerja belum di tentukan', 'Mengalihkan ke halaman utama...');</script>";
} else {
  // CEK APAKAH SUDAH MENGIRIMKAN PERMOHONAN ATAU BELUM
  $queryAbsensiNow = querySQL("SELECT tanggal_permohonan, status_permohonan FROM absensi_cuti WHERE user_id = '$userId' AND tanggal_permohonan = '$now'");
  $dataAbsensi = mysqli_fetch_assoc($queryAbsensiNow);

  if (isset($_POST['permohonan_cuti'])) {
    $tanggalMulai = $_POST['tanggal_mulai'];
    $tanggalSelesai = $_POST['tanggal_selesai'];
    $keterangan = $_POST['keterangan'];
    $statusPermohonan = 'Menunggu';
  
    $queryPermohonan = querySQL("INSERT INTO absensi_cuti (user_id, tanggal_mulai, tanggal_selesai, keterangan, status_permohonan, tanggal_permohonan) VALUES ('$userId', '$tanggalMulai', '$tanggalSelesai', '$keterangan', '$statusPermohonan', '$now')");
    if ($queryPermohonan) {
      echo "<script>alertPopUp('?page=absensi_cuti', 'success', 'Permohonan cuti berhasil dikirim');</script>";
    } else {
      echo "<script>alertPopUp('index.php', 'error', 'Permohonan cuti gagal dikirim', 'Mengalihkan ke halaman utama...');</script>";
    }
  }
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Permohonan Cuti</h3>
    <div class="card card-outline card-primary">
      <div class="card-body my-3">
        <form method="post" id="form_absensi_cuti">
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
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
          </div>
        </form>
        <?php if (isset($dataAbsensi)) { ?>
          <div class="alert alert-info">Hari ini sudah mengirim permohonan cuti, <a href="?page=histori&td=cuti">lihat histori permohonan cuti</a></div>
        <?php } ?>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <?php if (isset($dataAbsensi)) { ?>
          <button type="submit" disabled class="btn btn-primary">Kirim permohonan</button>
        <?php } else { ?>
          <button type="submit" form="form_absensi_cuti" name="permohonan_cuti" class="btn btn-primary">Kirim permohonan</button>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php } ?>