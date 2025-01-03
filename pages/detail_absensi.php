<?php include 'config/functions.php';
$idDetail = $_GET['id']; $level = $_SESSION['pengguna']['level']; $now = date('Y-m-d');
$queryDetail = querySQL("SELECT * FROM absensi LEFT JOIN users ON absensi.user_id = users.id_user WHERE id_absensi = '$idDetail'");
$dataDetail = mysqli_fetch_assoc($queryDetail);
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Detail Absensi</h3>
    <div class="card card-outline card-info">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap">
            <tr>
              <th>Nama</th>
              <td><?= $dataDetail['nama_lengkap'] ?></td>
            </tr>
            <tr>
              <th>Tanggal Absen</th>
              <td><?= $dataDetail['tanggal_absensi'] ?></td>
            </tr>
            <tr>
              <th>Jam Masuk</th>
              <td><?= $dataDetail['jam_masuk'] ?></td>
            </tr>
            <tr>
              <th>Jam Keluar</th>
              <td><?= isset($dataDetail['jam_keluar']) ? $dataDetail['jam_keluar'] : '-' ?></td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <td>
                <?php
                  $idJK = $dataDetail['jk_id'];
                  $queryJamKerja = querySQL("SELECT jam_masuk FROM jam_kerja WHERE id_jk = '$idJK'");
                  $dataJamKerja = mysqli_fetch_assoc($queryJamKerja);
                  if ($dataDetail['jam_masuk'] <= $dataJamKerja['jam_masuk']) {
                ?>
                  <div class="badge badge-success">Tepat Waktu</div>
                <?php } else { ?>
                  <div class="badge badge-danger">Terlambat</div>
                <?php } ?>
              </td>
            </tr>
          </table>
        </div>
        <div class="row">
          <div class="col-12 col-md-6 mb-3 d-flex flex-column align-items-center">
            <p>Foto Absen Masuk :</p>
            <img width="50%" height="50%" src="dist/img/absensi/<?= $dataDetail['foto_masuk'] ?>" class="img-fluid">
          </div>
          <div class="col-12 col-md-6 mb-3 d-flex flex-column align-items-center">
            <p>Foto Absen Keluar :</p>
            <?php if ($dataDetail['foto_keluar'] !== null) { ?>
              <img width="50%" height="50%" src="dist/img/absensi/<?= $dataDetail['foto_keluar'] ?>" class="img-fluid">
            <?php } else if ($dataDetail['tanggal_absensi'] !== $now) { ?>
              <p class="text-center">Karyawan tidak melakukan absen keluar</p>
            <?php } else { ?>
              <p class="text-center">Karyawan belum melakukan absen keluar</p>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <?php if ($level === 'Karyawan') { ?>
          <a href="?page=histori&td=absensi" class="btn btn-secondary">Kembali</a>
        <?php } else { ?>
          <a href="?page=data_absensi" class="btn btn-secondary">Kembali</a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>