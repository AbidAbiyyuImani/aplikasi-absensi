<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

if(isset($_POST['tambahJamKerja'])) {
  try {
    $jamMasuk = $_POST['jamMasuk'];
    $jamKeluar = $_POST['jamKeluar'];
  
    $queryInsert = querySQL("INSERT INTO jam_kerja(jam_masuk, jam_keluar) VALUES('$jamMasuk', '$jamKeluar')");
    if($queryInsert) {
      echo "<script>alert('Tambah Jam Kerja Berhasil');location.href='?page=data_jam';</script>";
    } else {
      echo "<script>alert('Tambah Jam Kerja Gagal');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Tambah Jam Kerja Gagal');location.href='?page=data_jam';</script>";
  }
}
?>

<div class="row">
  <div class="col-12">
    <div class="card">
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
              <input type="time" name="jamKeluar" id="jamKeluar" required class="form-control">
            </div>
          </div>
          <a href="?page=data_jam" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="tambahJamKerja" class="btn btn-primary">Tambah Jam Kerja</button>
        </form>
      </div>
    </div>
  </div>
</div>