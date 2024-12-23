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
        echo "<script>alertPopUp('?page=data_divisi', 'success', 'Berhasil menambahkan data divisi', 'Mengalihkan ke halaman data divisi...');</script>";
      } else {
        echo "<script>alertPopUp(null, 'error', 'Gagal menambahkan data divisi');</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp(null, 'warning', 'Nama divisi sudah terdaftar', 'Masukan nama divisi yang berbeda!');</script>";
    }
  }
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Tambah Divisi</h3>
    <div class="card card-outline card-primary">
      <div class="card-body">
        <form id="form_tambah_divisi" method="post">
          <div class="form-group">
            <label for="namaDivisi">Nama Divisi</label>
            <input type="text" name="namaDivisi" id="namaDivisi" required class="form-control">
          </div>
        </form>
        <a href="?page=data_divisi" class="btn btn-secondary">Kembali</a>
        <button type="submit" form="form_tambah_divisi" name="tambahDivisi" class="btn btn-primary">Tambahkan Divisi</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>