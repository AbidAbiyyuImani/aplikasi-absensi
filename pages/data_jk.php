<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'Karyawan') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };
?>
<?php $namaHalaman = "Jam Kerja"; $linkHalaman = "Data Jam Kerja"; include 'components/breadcrumb.php';?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap table-data">
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
                    <a href="?page=hapus_jk&id=<?= $dataJamKerja['id_jk'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data jam kerja ini?')" class="btn btn-danger">Hapus</a>
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