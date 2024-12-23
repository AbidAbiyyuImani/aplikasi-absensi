<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if(isset($_POST['tambahJamKerja'])) {
    try {
      $jamMasuk = $_POST['jamMasuk'];
      $jamPulang = $_POST['jamPulang'];
    
      $queryInsert = querySQL("INSERT INTO jam_kerja(jam_masuk, jam_pulang) VALUES('$jamMasuk', '$jamPulang')");
      if($queryInsert) {
        echo "<script>alertPopUp('?page=data_jk', 'success', 'Berhasil menambahkan data jam kerja', 'Mengalihkan ke halaman data jam kerja...');</script>";
      } else {
        echo "<script>alertPopUp(null, 'error', 'Gagal menambahkan data jam kerja');</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp(null, 'warning', 'Tidak dapat menambahkan data jam kerja');</script>";
    }
  }
?>
<?php $namaHalaman = "Tambah Jam Kerja"; $linkHalaman = "Tambah Data Jam Kerja"; include 'components/breadcrumb.php';?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <form method="post">
          <h3 class="mb-3">Tambah Jam Kerja</h3>
          <div class="row">
            <div class="form-group col-12 col-sm-6">
              <label for="jamMasuk" class="form-label">Jam Masuk</label>
              <input type="time" name="jamMasuk" id="jamMasuk" required class="form-control">
            </div>
            <div class="form-group col-12 col-sm-6">
              <label for="jamMasuk" class="form-label">Jam Keluar</label>
              <input type="time" name="jamPulang" id="jamPulang" required class="form-control">
            </div>
          </div>
          <a href="?page=data_jk" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="tambahJamKerja" class="btn btn-primary">Tambah Jam Kerja</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>