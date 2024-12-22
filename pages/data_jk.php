<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
?>
<?php $namaHalaman = "Jam Kerja"; $linkHalaman = "Data Jam Kerja"; include 'components/breadcrumb.php'; ?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-info">
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table table-bordered text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              $queryJamKerja = querySQL("SELECT * FROM jam_kerja");
              while ($dataJamKerja = mysqli_fetch_assoc($queryJamKerja)) {
                ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataJamKerja['jam_masuk'] ?></td>
                  <td><?= $dataJamKerja['jam_pulang'] ?></td>
                  <td>
                    <a href="?page=ubah_jk&id=<?= $dataJamKerja['id_jk'] ?>" class="btn btn-warning">Ubah</a>
                    <button onclick="return confirmPopUp('warning', 'Hapus Jam Kerja', 'Apakah anda yakin ingin menghapus data jam kerja ini?', 'Yakin', 'Tidak', '?page=hapus_jk&id=<?= $dataJamKerja['id_jk'] ?>', '?page=data_jk');" class="btn btn-danger">Hapus</button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <a href="?page=tambah_jk" class="btn btn-primary float-right">Tambah</a>
      </div>
    </div>
  </div>
</div>
<?php } ?>