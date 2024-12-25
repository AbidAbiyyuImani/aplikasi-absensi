<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_GET['id'])) {
    $idJK = $_GET['id'];
    $queryJamKerja = querySQL("SELECT * FROM jam_kerja WHERE id_jk = '$idJK'");
    $dataJamKerja = mysqli_fetch_assoc($queryJamKerja);
  
    if (isset($_POST['ubahJk'])) {
      try {
        $jamMasuk = $_POST['jamMasuk'];
        $jamKeluar = $_POST['jamKeluar'];
  
        $queryUpdate = querySQL("UPDATE jam_kerja SET jam_masuk = '$jamMasuk', jam_keluar = '$jamKeluar' WHERE id_jk = '$idJK'");
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
        <form id="form_ubah_jk" method="post">
          <div class="row">
            <div class="form-group col-12 col-sm-6">
              <label for="jamMasuk" class="form-label">Jam Masuk</label>
              <input type="time" name="jamMasuk" id="jamMasuk" required value="<?= $dataJamKerja['jam_masuk']; ?>" class="form-control">
            </div>
            <div class="form-group col-12 col-sm-6">
              <label for="jamMasuk" class="form-label">Jam Keluar</label>
              <input type="time" name="jamKeluar" id="jamKeluar" required value="<?= $dataJamKerja['jam_keluar']; ?>" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer">
        <a href="?page=data_jk" class="btn btn-secondary">Kembali</a>
        <button type="submit" name="ubahJk" form="form_ubah_jk" class="btn btn-warning">Ubah Jam Kerja</button>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
  <script>
    alertPopUp('?page=data_jk', 'error', 'Tidak ada data jam kerja yang dipilih', 'Mengalihkan ke halaman data jam kerja...');
  </script>
<?php } } ?>