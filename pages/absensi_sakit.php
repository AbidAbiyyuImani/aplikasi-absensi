<d?php include 'config/functions.php';
$userId = $_SESSION['pengguna']['id_user']; $now = date('Y-m-d');
$queryIzinSakit = querySQL("SELECT tanggal_permohonan, status_permohonan FROM absensi_sakit WHERE user_id = '$userId' AND tanggal_permohonan = '$now'");

?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Permohonan Sakit</h3>
    <div class="card">
      <div class="card-body">
        <form id="form_absensi_sakit" method="post" enctype="multipart/form-data">
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
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <?php if (isset($queryIzinSakit)) { ?>
          <button type="submit" disabled class="btn btn-primary">Kirim permohonan</button>
        <?php } else { ?>
          <button type="submit" form="form_absensi_sakit" name="permohonan_sakit" class="btn btn-primary">Kirim permohonan</button>
        <?php } ?>
      </div>
    </div>
  </div>
</div>