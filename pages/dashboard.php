<?php include 'config/functions.php'; $level = $_SESSION['pengguna']['level'];
switch ($level) {
  case "Super Admin": ?>
<?php case "Admin": ?>

<div class="row">
  <div class="col-12">
    <h3 class="mb-3"><?= getDateTimeNow(); ?></h3>
  </div>
  <div class="col-12 col-sm-6 col-md-4">
    <a href="?page=data_karyawan">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Karyawan</span>
          <span class="info-box-number"><?= getTotal("users"); ?></span>
        </div>
      </div>
    </a>
  </div>
  <div class="col-12 col-sm-6 col-md-4">
    <a href="?page=data_divisi">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Divisi</span>
          <span class="info-box-number"><?= getTotal("divisi"); ?></span>
        </div>
      </div>
    </a>
  </div>
  <div class="col-12 col-sm-6 col-md-4">
    <a href="?page=data_jam">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-clock"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Jam Kerja</span>
          <span class="info-box-number"><?= getTotal("jam_kerja") ?></span>
        </div>
      </div>
    </a>
  </div>
</div>

<?php break; case "User": ?>
<?php
$idDivisi = $_SESSION['pengguna']['divisi_id'];
$idJamKerja = $_SESSION['pengguna']['jam_id'];

$queryDivisi = querySQL("SELECT * FROM divisi WHERE id_divisi = '$idDivisi'");
$queryJamKerja = querySQL("SELECT * FROM jam_kerja WHERE id_jam = '$idJamKerja'");

$dataDivisi = mysqli_fetch_assoc($queryDivisi);
$dataJamKerja = mysqli_fetch_assoc($queryJamKerja);
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-3"><?= getDateTimeNow(); ?></h3>
        <div class="table-responsive mb-2">
          <table class="table table-bordered text-nowrap">
            <tbody>
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $_SESSION['pengguna']['nama_lengkap'] ?></td>
              </tr>
              <tr>
                <td>Divisi</td>
                <td>:</td>
                <td><?= $dataDivisi['nama_divisi'] ?></td>
              </tr>
              <tr>
                <td>Jam Kerja</td>
                <td>:</td>
                <td><?= $dataJamKerja['jam_masuk'] . ' - ' . $dataJamKerja['jam_keluar'] ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <a href="?page=absen_masuk" class="btn bg-gradient-success mb-2 d-inline-block col-12">Absen Masuk</a>
        <a href="?page=absen_keluar" class="btn bg-gradient-warning mb-2 d-inline-block col-12">Absen Keluar</a>
        <a href="?page=absen_cuti" class="btn bg-gradient-secondary mb-2 d-inline-block col-12">Absen Cuti</a>
        <a href="?page=absen_sakit" class="btn bg-gradient-danger mb-2 d-inline-block col-12">Absen Sakit</a>
      </div>
    </div>
  </div>
</div>

<?php break; } ?>