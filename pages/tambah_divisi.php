<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'Karyawan') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

if (isset($_POST['tambahDivisi'])) {
  try {
    $namaDivisi = $_POST['namaDivisi'];
    
    $queryInsert = querySQL("INSERT INTO divisi (nama_divisi) VALUES ('$namaDivisi')");
    if ($queryInsert) {
      echo "<script>alert('Berhasil Menambahkan Divisi');location.href='?page=data_divisi';</script>";
    } else {
      echo "<script>alert('Gagal Menambahkan Divisi');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Nama divisi sudah terdaftar);location.href='?page=tambah_divisi';</script>";
  }
}
?>

<div class="row">
  <div class="col-12">
    <div class="card">
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