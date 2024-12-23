<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Data Divisi</h3>
    <div class="card card-outline card-info">
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table table-bordered text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Divisi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $queryDivisi = querySQL("SELECT * FROM divisi ORDER BY id_divisi ASC");
                while ($dataDivisi = mysqli_fetch_assoc($queryDivisi)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataDivisi['nama_divisi'] ?></td>
                  <td>
                    <a href="?page=ubah_divisi&id=<?= $dataDivisi['id_divisi'] ?>" class="btn btn-warning">Ubah</a>
                    <button onclick="return confirmPopUp('warning', 'Hapus Divisi', 'Apakah anda yakin ingin menghapus data divisi ini?', 'Yakin', 'Tidak', '?page=hapus_divisi&id=<?= $dataDivisi['id_divisi'] ?>', '?page=data_divisi');" class="btn btn-danger">Hapus</button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <a href="?page=tambah_divisi" class="btn btn-primary float-right">Tambah</a>
      </div>
    </div>
  </div>
</div>
<?php } ?>