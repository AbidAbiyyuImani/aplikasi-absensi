<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Data Absensi</h3>
    <div class="card card-outline card-info">
      <div class="card-body">
        <div class="table-responsive">
          <table id="export-table-data" class="table table-bordered text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $queryAbsensi = querySQL("SELECT * FROM absensi LEFT JOIN users ON absensi.user_id = users.id_user");
                while ($dataAbsensi = mysqli_fetch_assoc($queryAbsensi)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataAbsensi['nama_lengkap'] ?></td>
                  <td><?= $dataAbsensi['tanggal_absensi'] ?></td>
                  <td><?= $dataAbsensi['jam_masuk'] ?></td>
                  <td><?= $dataAbsensi['jam_keluar'] ?></td>
                  <td>
                    <a href="?page=detail_absensi&id=<?= $dataAbsensi['id_absensi'] ?>" class="btn btn-info">Detail</a>
                    <button onclick="return confirmPopUp('warning', 'Hapus Absensi', 'Apakah anda yakin ingin menghapus data absensi ini?', 'Yakin', 'Tidak', '?page=hapus_absensi&id=<?= $dataAbsensi['id_absensi'] ?>', '?page=data_absensi');" class="btn btn-danger">Hapus</button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
  </div>
</div>
<?php } ?>