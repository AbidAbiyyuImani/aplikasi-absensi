<?php include 'config/functions.php';
$userId = $_SESSION['pengguna']['id_user']; $now = date('Y-m-d');
$queryIzinSakit = querySQL("SELECT tanggal_permohonan, status_permohonan FROM absensi_sakit WHERE user_id = '$userId' AND tanggal_permohonan = '$now'");
$dataAbsensi = mysqli_fetch_assoc($queryIzinSakit);

if ($_SESSION['pengguna']['jk_id'] == null) {
  echo "<script>alertPopUp('index.php', 'error', 'Jam Kerja belum di tentukan', 'Mengalihkan ke halaman utama...');</script>";
}

if (isset($_POST['permohonan_sakit'])) {
  $suratSakit = upload('surat_sakit', ['jpg', 'jpeg', 'png', 'pdf'], 'dist/files/surat-sakit/');
  $keterangan = $_POST['keterangan'];
  $statusPermohonan = 'Menunggu';

  $queryPermohonan = querySQL("INSERT INTO absensi_sakit (user_id, surat_sakit, keterangan, status_permohonan, tanggal_permohonan) VALUES ('$userId', '$suratSakit', '$keterangan', '$statusPermohonan', '$now')");
  if ($queryPermohonan) {
    echo "<script>alertPopUp(null, 'success', 'Permohonan sakit berhasil dikirim');</script>";
  } else {
    echo "<script>alertPopUp('index.php', 'error', 'Permohonan sakit gagal dikirim', 'Mengalihkan ke halaman utama...');</script>";
  }
}
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Permohonan Sakit</h3>
    <div class="card mb-3">
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
        <?php if (isset($dataAbsensi)) { ?>
          <button type="submit" disabled class="btn btn-primary">Kirim permohonan</button>
        <?php } else { ?>
          <button type="submit" form="form_absensi_sakit" name="permohonan_sakit" class="btn btn-primary">Kirim permohonan</button>
        <?php } ?>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table table-bordered text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Status Permohonan</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $queryAbsensiSakit = querySQL("SELECT * FROM absensi_sakit WHERE user_id = '$userId' ORDER BY tanggal_permohonan DESC");
                $i = 1;
                while ($dataAbsensiSakit = mysqli_fetch_assoc($queryAbsensiSakit)) {
              ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $dataAbsensiSakit['tanggal_permohonan']; ?></td>
                  <td><?= $dataAbsensiSakit['keterangan']; ?></td>
                  <td>
                    <?php
                    $status = $dataAbsensiSakit['status_permohonan'];
                    switch ($status) { case 'Menunggu': ?>
                      <div class="badge badge-secondary">Menunggu</div>
                    <?php break; case 'Diterima': ?>
                      <div class="badge badge-success">Diterima</div>
                    <?php break; case 'Ditolak': ?>
                      <div class="badge badge-danger">Ditolak</div>
                    <?php break; } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>