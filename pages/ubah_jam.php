<?php include 'config/functions.php';
$idJam = $_GET['id'];
$queryJamKerja = querySQL("SELECT * FROM jam_kerja WHERE id_jam = $idJam");
$dataJamKerja = mysqli_fetch_assoc($queryJamKerja);

if(isset($_POST['ubah_jam_kerja'])) {
  $jamMasuk = $_POST['jamMasuk'];
  $jamKeluar = $_POST['jamKeluar'];

  $queryUpdate = querySQL("UPDATE jam_kerja SET jam_masuk = '$jamMasuk', jam_keluar = '$jamKeluar' WHERE id_jam = $idJam");
  if($queryUpdate) {
    echo "<script>alert('Ubah Jam Kerja Berhasil'); location.href='?page=data_jam'</script>";
  } else {
    echo "<script>alert('Ubah Jam Kerja Gagal')</script>";
  }
}
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="post">
          <h3 class="mb-3">Ubah Jam Kerja</h3>
          <div class="row">
            <div class="form-group col-12 col-sm-6">
              <label for="jamMasuk" class="form-label">Jam Masuk</label>
              <input type="time" name="jamMasuk" id="jamMasuk" value="<?= $dataJamKerja['jam_masuk'] ?>" class="form-control">
            </div>
            <div class="form-group col-12 col-sm-6">
              <label for="jamMasuk" class="form-label">Jam Keluar</label>
              <input type="time" name="jamKeluar" id="jamKeluar" value="<?= $dataJamKerja['jam_keluar'] ?>" class="form-control">
            </div>
          </div>
          <a href="?page=data_jam" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="ubah_jam_kerja" class="btn btn-warning">Ubah Jam Kerja</button>
        </form>
      </div>
    </div>
  </div>
</div>