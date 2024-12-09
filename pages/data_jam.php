<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };
?>
<?php $namaHalaman = "Jam Kerja"; $linkHalaman = "Data Jam Kerja"; include 'components/breadcrumb.php';?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap">
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
                  <td><?= $dataJamKerja['jam_keluar'] ?></td>
                  <td>
                    <a href="?page=ubah_jam&id=<?= $dataJamKerja['id_jam'] ?>" class="btn btn-warning">Ubah</a>
                    <a href="?page=hapus_jam&id=<?= $dataJamKerja['id_jam'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data jam kerja ini?')" class="btn btn-danger">Hapus</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <a href="?page=tambah_jam" class="btn btn-primary float-right">Tambah</a>
      </div>
    </div>
  </div>
</div>