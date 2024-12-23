<?php include 'config/functions.php';
$userId = $_SESSION['pengguna']['id_user']; $now = date('Y-m-d');
$queryAbsensiNow = querySQL("SELECT tanggal_permohonan, status_permohonan FROM absensi_izin WHERE user_id = '$userId' AND tanggal_permohonan = '$now'");
$dataAbsensi = mysqli_fetch_assoc($queryAbsensiNow);

if ($_SESSION['pengguna']['jk_id'] == null) {
  echo "<script>alertPopUp('index.php', 'error', 'Jam Kerja belum di tentukan', 'Mengalihkan ke halaman utama...');</script>";
}

if (isset($_POST['permohonan_izin'])) {
  $jamAwal = $_POST['jam_awal'];
  $jamAkhir = $_POST['jam_akhir'];
  $keterangan = $_POST['keterangan'];
  $statusPermohonan = 'Menunggu';

  $queryPermohonan = querySQL("INSERT INTO absensi_izin (user_id, jam_awal, jam_akhir, keterangan, status_permohonan, tanggal_permohonan) VALUES ('$userId', '$jamAwal', '$jamAkhir', '$keterangan', '$statusPermohonan', '$now')");
  if ($queryPermohonan) {
    echo "<script>alertPopUp(null, 'success', 'Permohonan izin berhasil dikirim');</script>";
  } else {
    echo "<script>alertPopUp('index.php', 'error', 'Permohonan izin gagal dikirim', 'Mengalihkan ke halaman utama...');</script>";
  }
}
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Permohonan Izin</h3>
    <div class="card mb-3">
      <div class="card-body my-3">
        <form id="form_absensi_izin" method="post">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="jam_awal">Jam Awal</label>
                <input type="time" name="jam_awal" id="jam_awal" class="form-control">
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="jam_akhir">Jam Akhir</label>
                <input type="time" name="jam_akhir" id="jam_akhir" class="form-control">
              </div>
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
          <button type="submit" form="form_absensi_izin" name="permohonan_izin" class="btn btn-primary">Kirim permohonan</button>
        <?php } ?>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap">
            <thead>
              <th>No</th>
              <th>Tanggal</th>
              <th>Keterangan</th>
              <th>Status Permohonan</th>
            </thead>
            <tbody>
              <?php
              $i = 1;
              $queryAbsensiIzin = querySQL("SELECT * FROM absensi_izin WHERE user_id = '$userId'");
              while ($dataAbsensiIzin = mysqli_fetch_assoc($queryAbsensiIzin)) {
                ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataAbsensiIzin['tanggal_permohonan'] ?></td>
                  <td><?= $dataAbsensiIzin['keterangan'] ?></td>
                  <td>
                    <?php
                    $status = $dataAbsensiIzin['status_permohonan'];
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