<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_POST['tambahDivisi'])) {
    try {
      $namaDivisi = $_POST['namaDivisi'];
      
      $queryInsert = querySQL("INSERT INTO divisi (nama_divisi) VALUES ('$namaDivisi')");
      if ($queryInsert) {
        echo "<script>alertPopUp('?page=data_divisi', 'success', 'Berhasil menambahkan divisi', 'Mengalihkan ke halaman data divisi...');</script>";
      } else {
        echo "<script>alertPopUp(null, 'error', 'Gagal menambahkan divisi', null);</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp(null, 'warning', 'Nama divisi sudah terdaftar', 'Masukan nama divisi yang berbeda!');</script>";
    }
  }
?>
<?php $namaHalaman = "Tambah Divisi"; $linkHalaman = "Tambah Data Divisi"; include 'components/breadcrumb.php';?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label for="namaDivisi">Nama Divisi</label>
            <input type="text" name="namaDivisi" id="namaDivisi" required class="form-control">
          </div>
          <a href="?page=data_divisi" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="tambahDivisi" class="btn btn-primary">Tambahkan Divisi</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>