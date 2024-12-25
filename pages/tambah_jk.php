<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if(isset($_POST['tambahJk'])) {
    try {
      $jamMasuk = $_POST['jamMasuk'];
      $jamKeluar = $_POST['jamKeluar'];
    
      $queryInsert = querySQL("INSERT INTO jam_kerja(jam_masuk, jam_keluar) VALUES('$jamMasuk', '$jamKeluar')");
      if($queryInsert) {
        echo "<script>alertPopUp('?page=data_jk', 'success', 'Berhasil menambahkan data jam kerja', 'Mengalihkan ke halaman data jam kerja...');</script>";
      } else {
        echo "<script>alertPopUp(null, 'error', 'Gagal menambahkan data jam kerja');</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp('?page=data_jk', 'warning', 'Tidak dapat menambahkan data jam kerja');</script>";
    }
  }
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Tambah Jam Kerja</h3>
    <div class="card card-outline card-primary">
      <div class="card-body">
        <form id="form_tambah_jk" method="post">
          <div class="row">
            <div class="form-group col-12 col-sm-6">
              <label for="jamMasuk" class="form-label">Jam Masuk</label>
              <input type="time" name="jamMasuk" id="jamMasuk" required class="form-control">
            </div>
            <div class="form-group col-12 col-sm-6">
              <label for="jamMasuk" class="form-label">Jam Keluar</label>
              <input type="time" name="jamKeluar" id="jamKeluar" required class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer">
        <a href="?page=data_jk" class="btn btn-secondary">Kembali</a>
        <button type="submit" name="tambahJk" form="form_tambah_jk" class="btn btn-primary">Tambahkan Jam Kerja</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>