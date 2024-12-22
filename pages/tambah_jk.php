<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') { echo "<script>popUp(false, 'index.php', 'Hanya admin yang dapat mengakses', 'Mengalihkan ke halaman utama...', 'error', 3000);</script>"; }

if(isset($_POST['tambahJamKerja'])) {
  try {
    $jamMasuk = $_POST['jamMasuk'];
    $jamPulang = $_POST['jamPulang'];
  
    $queryInsert = querySQL("INSERT INTO jam_kerja(jam_masuk, jam_pulang) VALUES('$jamMasuk', '$jamPulang')");
    if($queryInsert) {
      echo "<script>popUp(false, '?page=data_jk', 'Berhasil menambahkan jam kerja', 'Mengalihkan ke halaman data jam kerja...', 'success');</script>";
    } else {
      echo "<script>popUp(false, '?page=data_jk', 'Gagal menambahkan jam kerja', 'Mengalihkan ke halaman data jam kerja...', 'error');</script>";
    }
  } catch (Exception $e) {
    echo "<script>popUp(false, '?page=data_jk', 'Tidak dapat menambahkan jam kerja', 'Mengalihkan ke halaman data jam kerja...', 'error');</script>";
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