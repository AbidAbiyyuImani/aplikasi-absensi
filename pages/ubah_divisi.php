<?php include 'config/functions.php';
$idDivisi = $_GET['id'];
$queryDivisi = querySQL("SELECT * FROM divisi WHERE id_divisi = $idDivisi");
$dataDivisi = mysqli_fetch_assoc($queryDivisi);

if(isset($_POST['ubah_divisi'])) {
  $namaDivisi = $_POST['namaDivisi'];

  $queryUpdate = querySQL("UPDATE divisi SET nama_divisi = '$namaDivisi' WHERE id_divisi = $idDivisi");
  if($queryUpdate) {
    echo "<script>alert('Ubah Data Divisi Berhasil'); location.href='?page=data_divisi'</script>";
  } else {
    echo "<script>alert('Ubah Data Divisi Gagal')</script>";
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
            <input type="text" name="namaDivisi" id="namaDivisi" value="<?= $dataDivisi['nama_divisi'] ?>" autofocus class="form-control">
          </div>
          <a href="?page=data_divisi" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="ubah_divisi" class="btn btn-warning">Ubah Divisi</button>
        </form>
      </div>
    </div>
  </div>
</div>