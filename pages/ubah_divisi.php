<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idDivisi = $_GET['id'];
$queryDivisi = querySQL("SELECT * FROM divisi WHERE id_divisi = '$idDivisi'");
$dataDivisi = mysqli_fetch_assoc($queryDivisi);

if(isset($_POST['ubah_divisi'])) {
  try {
    $namaDivisi = $_POST['namaDivisi'];
    
    $queryUpdate = querySQL("UPDATE divisi SET nama_divisi = '$namaDivisi' WHERE id_divisi = '$idDivisi'");
    if($queryUpdate) {
      echo "<script>alert('Ubah Data Divisi Berhasil');location.href='?page=data_divisi';</script>";
    } else {
      echo "<script>alert('Ubah Data Divisi Gagal');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Nama Divisi Sudah Terdaftar');location.href='?page=data_divisi';</script>";
  }
}
?>

<div class="row">
  <div class="col-12">
    <div class="card card-outline card-warning">
      <div class="card-body">
        <h3 class="mb-3">Ubah Nama Divisi</h3>
        <form method="post">
          <div class="form-group">
            <label for="namaDivisi">Nama Divisi</label>
            <input type="text" name="namaDivisi" id="namaDivisi" value="<?= $dataDivisi['nama_divisi']; ?>" required class="form-control">
          </div>
          <a href="?page=data_divisi" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="ubah_divisi" class="btn btn-warning float-right">Ubah Data Divisi</button>
        </form>
      </div>
    </div>
  </div>
</div>