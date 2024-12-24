<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_GET['id'])) {
    $idDivisi = $_GET['id'];
    $queryDivisi = querySQL("SELECT * FROM divisi WHERE id_divisi = '$idDivisi'");
    $dataDivisi = mysqli_fetch_assoc($queryDivisi);

    if (isset($_POST['ubah_divisi'])) {
      try {
        $namaDivisi = $_POST['namaDivisi'];

        $queryUpdate = querySQL("UPDATE divisi SET nama_divisi = '$namaDivisi' WHERE id_divisi = '$idDivisi'");
        if ($queryUpdate) {
          echo "<script>alertPopUp('?page=data_divisi', 'success', 'Berhasil menghubah data divisi', 'Mengalihkan ke halaman data divisi...');</script>";
        } else {
          echo "<script>alertPopUp(null, 'error', 'Gagal menghubah data divisi');</script>";
        }
      } catch (Exception $e) {
        echo "<script>alertPopUp(null, 'warning', 'Nama divisi sudah terdaftar');</script>";
      }
    }
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Ubah Data Divisi</h3>
    <div class="card card-outline card-warning">
      <div class="card-body">
        <form id="ubah_data_divisi" method="post">
          <div class="form-group">
            <label for="namaDivisi">Nama Divisi</label>
            <input type="text" name="namaDivisi" id="namaDivisi" value="<?= $dataDivisi['nama_divisi']; ?>" required class="form-control">
          </div>
        </form>
        <a href="?page=data_divisi" class="btn btn-secondary">Kembali</a>
        <button type="submit" name="ubah_divisi" form="ubah_data_divisi" class="btn btn-warning float-right">Ubah Data Divisi</button>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
  <script>
    alertPopUp('?page=data_divisi', 'error', 'Tidak ada data divisi yang dipilih', 'Mengalihkan ke halaman data divisi...');
  </script>
<?php } } ?>