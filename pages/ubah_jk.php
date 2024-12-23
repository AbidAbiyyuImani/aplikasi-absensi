<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_GET['id'])) {
    $idJK = $_GET['id'];
    $queryJamKerja = querySQL("SELECT * FROM jam_kerja WHERE id_jk = '$idJK'");
    $dataJamKerja = mysqli_fetch_assoc($queryJamKerja);
  
    if (isset($_POST['ubah_jam_kerja'])) {
      try {
        $jamMasuk = $_POST['jamMasuk'];
        $jamPulang = $_POST['jamPulang'];
  
        $queryUpdate = querySQL("UPDATE jam_kerja SET jam_masuk = '$jamMasuk', jam_pulang = '$jamPulang' WHERE id_jk = '$idJK'");
        if ($queryUpdate) {
          echo "<script>alertPopUp('?page=data_jk', 'success', 'Berhasil menghubah data jam kerja', 'Mengalihkan ke halaman data jam kerja...');</script>";
        } else {
          echo "<script>alertPopUp(null, 'error', 'Gagal menghubah data jam kerja');</script>";
        }
      } catch (Exception $e) {
        echo "<script>alertPopUp('?page=data_jk', 'warning', 'Tidak dapat menghubah data jam kerja', 'Mengalihkan ke halaman data jam kerja...');</script>";
      }
    }
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Ubah Data Jam Kerja</h3>
    <div class="card card-outline card-warning">
      <div class="card-body">
        <form id="ubah_data_jk" method="post">
          <div class="row">
            <div class="form-group col-12 col-sm-6">
              <label for="jamMasuk" class="form-label">Jam Masuk</label>
              <input type="time" name="jamMasuk" id="jamMasuk" required value="<?= $dataJamKerja['jam_masuk']; ?>" class="form-control">
            </div>
            <div class="form-group col-12 col-sm-6">
              <label for="jamMasuk" class="form-label">Jam Keluar</label>
              <input type="time" name="jamPulang" id="jamPulang" required value="<?= $dataJamKerja['jam_pulang']; ?>" class="form-control">
            </div>
          </div>
        </form>
        <a href="?page=data_jk" class="btn btn-secondary">Kembali</a>
        <button type="submit" name="ubah_jam_kerja" form="ubah_data_jk" class="btn btn-warning">Ubah Jam Kerja</button>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
  <script>
    alertPopUp('?page=data_jk', 'error', 'Tidak ada data jam kerja yang dipilih', 'Mengalihkan ke halaman data jam kerja...');
  </script>
<?php } } ?>