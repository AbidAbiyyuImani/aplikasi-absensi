<?php include 'config/functions.php';
$idUser = $_SESSION['pengguna']['id_user'];
if (isset($_GET['td'])) {
  $td = $_GET['td'];
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Histori Absensi</h3>
    <div class="card card-outline card-info">
      <ul class="nav nav-pills p-2">
        <li class="nav-item">
          <a href="?page=histori&td=absensi" class="nav-link <?= ($td == 'absensi') ? 'active' : '' ?>">Absensi</a>
        </li>
        <li class="nav-item">
          <a href="?page=histori&td=izin" class="nav-link <?= ($td == 'izin') ? 'active' : '' ?>">Izin</a>
        </li>
        <li class="nav-item">
          <a href="?page=histori&td=sakit" class="nav-link <?= ($td == 'sakit') ? 'active' : '' ?>">Sakit</a>
        </li>
        <li class="nav-item">
          <a href="?page=histori&td=cuti" class="nav-link <?= ($td == 'cuti') ? 'active' : '' ?>">Cuti</a>
        </li>
      </ul>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table table-bordered text-nowrap">
            <?php switch($td) { case 'absensi': ?>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Jam Masuk</th>
                  <th>Jam Keluar</th>
                  <th>Keterangan</th>
                  <th>Detail</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  $queryAbsensi = querySQL("SELECT * FROM absensi WHERE user_id = '$idUser'");
                  while ($dataAbsensi = mysqli_fetch_assoc($queryAbsensi)) {
                ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $dataAbsensi['tanggal_absensi'] ?></td>
                    <td><?= $dataAbsensi['jam_masuk'] ?></td>
                    <td><?= $dataAbsensi['jam_keluar'] ?></td>
                    <td>
                      <?php
                        $idJK = $_SESSION['pengguna']['jk_id'];
                        $queryJamKerja = querySQL("SELECT jam_masuk FROM jam_kerja WHERE id_jk = '$idJK'");
                        $dataJamKerja = mysqli_fetch_assoc($queryJamKerja);
                        if ($dataAbsensi['jam_masuk'] <= $dataJamKerja['jam_masuk']) {
                      ?>
                        <div class="badge badge-success">Tepat Waktu</div>
                      <?php } else { ?>
                        <div class="badge badge-danger">Terlambat</div>
                      <?php } ?>
                    </td>
                    <td>
                      <a href="?page=detail_absensi&id=<?= $dataAbsensi['id_absensi'] ?>" class="btn btn-info">Detail</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            <?php break; case 'izin': ?>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Jam Awal</th>
                  <th>Jam Akhir</th>
                  <th>Keterangan</th>
                  <th>Status Permohonan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  $queryAbsensiIzin = querySQL("SELECT * FROM absensi_izin WHERE user_id = '$idUser'");
                  while ($dataAbsensiIzin = mysqli_fetch_assoc($queryAbsensiIzin)) {
                ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $dataAbsensiIzin['tanggal_permohonan'] ?></td>
                    <td><?= $dataAbsensiIzin['jam_awal'] ?></td>
                    <td><?= $dataAbsensiIzin['jam_akhir'] ?></td>
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
            <?php break; case 'sakit': ?>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Surat Sakit</th>
                  <th>Keterangan</th>
                  <th>Tanggal Mulai Sakit</th>
                  <th>Tanggal Selesai Sakit</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  $queryAbsensiSakit = querySQL("SELECT * FROM absensi_sakit WHERE user_id = '$idUser'");
                  while ($dataAbsensiSakit = mysqli_fetch_assoc($queryAbsensiSakit)) {
                ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $dataAbsensiSakit['tanggal_permohonan'] ?></td>
                    <td><?= $dataAbsensiSakit['keterangan'] ?></td>
                    <td>
                      <a href="dist/img/surat-sakit/<?= $dataAbsensiSakit['surat_sakit'] ?>" target="_blank" class="btn btn-info">Lihat</a>
                    </td>
                    <td><?= $dataAbsensiSakit['tanggal_mulai'] ?></td>
                    <td><?= $dataAbsensiSakit['tanggal_selesai'] ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            <?php break; case 'cuti': ?>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Keterangan</th>
                  <th>Status Permohonan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  $queryAbsensiCuti = querySQL("SELECT * FROM absensi_cuti WHERE user_id = '$idUser'");
                  while ($dataAbsensiCuti = mysqli_fetch_assoc($queryAbsensiCuti)) {
                ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $dataAbsensiCuti['tanggal_permohonan'] ?></td>
                    <td><?= $dataAbsensiCuti['tanggal_mulai'] ?></td>
                    <td><?= $dataAbsensiCuti['tanggal_selesai'] ?></td>
                    <td><?= $dataAbsensiCuti['keterangan'] ?></td>
                    <td>
                      <?php
                      $status = $dataAbsensiCuti['status_permohonan'];
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
            <?php break; } ?>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
  <script>
    location.href='?page=histori&td=absensi';
  </script>
<?php } ?>