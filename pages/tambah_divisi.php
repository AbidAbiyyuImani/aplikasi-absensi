<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') { echo "<script>popUp(false, 'index.php', 'Hanya admin yang dapat mengakses', 'Mengalihkan ke halaman utama...', 'error', 3000);</script>"; }

if (isset($_POST['tambahDivisi'])) {
  try {
    $namaDivisi = $_POST['namaDivisi'];
    
    $queryInsert = querySQL("INSERT INTO divisi (nama_divisi) VALUES ('$namaDivisi')");
    if ($queryInsert) {
      echo "<script>popUp(false, '?page=data_divisi', 'Berhasil menambahkan divisi', 'Mengalihkan ke halaman data divisi...', 'success');</script>";
    } else {
      echo "<script>popUp(false, '?page=data_divisi', 'Gagal menambahkan divisi', 'Mengalihkan ke halaman data divisi...', 'error');</script>";
    }
  } catch (Exception $e) {
    echo "<script>popUp(false, '?page=tambah_divisi', 'Nama divisi sudah terdaftar', 'Mengalihkan ke halaman tambah divisi...', 'error');</script>";
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