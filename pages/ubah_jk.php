<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'Karyawan') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idJK = $_GET['id'];
$queryJamKerja = querySQL("SELECT * FROM jam_kerja WHERE id_jk = '$idJK'");
$dataJamKerja = mysqli_fetch_assoc($queryJamKerja);

if(isset($_POST['ubah_jam_kerja'])) {
  try {
    $jamMasuk = $_POST['jamMasuk'];
    $jamPulang = $_POST['jamPulang'];
  
    $queryUpdate = querySQL("UPDATE jam_kerja SET jam_masuk = '$jamMasuk', jam_pulang = '$jamPulang' WHERE id_jk = '$idJK'");
    if($queryUpdate) {
      echo "<script>alert('Ubah Jam Kerja Berhasil');location.href='?page=data_jk';</script>";
    } else {
      echo "<script>alert('Ubah Jam Kerja Gagal');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Tidak dapat mengubah jam kerja');location.href='?page=data_jk';</script>";
  }
}
?>

<div class="row">
  <div class="col-12">
    <div class="card card-outline card-warning">
      <div class="card-body">
        <h3 class="mb-3">Ubah Jam Kerja</h3>
        <form method="post">
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
          <a href="?page=data_jk" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="ubah_jam_kerja" class="btn btn-warning float-right">Ubah Jam Kerja</button>
        </form>
      </div>
    </div>
  </div>
</div>