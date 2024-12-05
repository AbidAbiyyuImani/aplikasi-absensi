<?php
if(isset($_POST['tambah'])) {
  $namaDivisi = $_POST['namaDivisi'];

  $query = "INSERT INTO divisi (nama_divisi) VALUES ('$namaDivisi')";
  $result = mysqli_query($db, $query);
  if($result) {
    echo "<script>alert('Berhasil menambahkan divisi!');location.href='?page=data_divisi'</script>";
  } else {
    echo "<script>alert('Gagal menambahkan divisi!')</script>";
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
            <input type="text" name="namaDivisi" id="namaDivisi" class="form-control">
          </div>
          <a href="?page=data_divisi" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="tambah" class="btn btn-primary">Tambahkan Divisi</button>
        </form>
      </div>
    </div>
  </div>
</div>