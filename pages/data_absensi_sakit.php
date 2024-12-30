<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
if (isset($_POST['status_permohonan'])) {
  $idAbsenPermohonanSakit = $_POST['id_absen_sakit'];
  $statusPermohonan = $_POST['status_permohonan'];

  $queryUpdateStatusPermohonan = querySQL("UPDATE absensi_sakit SET status_permohonan = '$statusPermohonan' WHERE id_absensi_sakit = '$idAbsenPermohonanSakit'");
  if ($queryUpdateStatusPermohonan) {
    echo "<script>alertPopUp('?page=data_absensi_sakit', 'success', 'Berhasil mengubah status permohonan sakit');</script>";
  } else {
    echo "<script>alertPopUp(null, 'error', 'Gagal mengubah status permohonan sakit');</script>";
  }
}
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Data Absensi Sakit</h3>
    <div class="card card-outline card-info">
      <div class="card-body">
        <div class="table-responsive">
          <table id="export-table-data" class="table table-bordered text-nowrap">
            <thead>
              <th>No</th>
              <th>Karyawan</th>
              <th>Keterangan</th>
              <th>Tanggal Mulai Sakit</th>
              <th>Tanggal Selesai Sakit</th>
              <th>Tanggal Permohonan</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $queryAbsensiSakit = querySQL("SELECT * FROM absensi_sakit LEFT JOIN users ON absensi_sakit.user_id = users.id_user");
                while ($dataAbsensiSakit = mysqli_fetch_assoc($queryAbsensiSakit)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataAbsensiSakit['nama_lengkap'] ?></td>
                  <td><?= $dataAbsensiSakit['keterangan'] ?></td>
                  <td><?= $dataAbsensiSakit['tanggal_mulai'] ?></td>
                  <td><?= $dataAbsensiSakit['tanggal_selesai'] ?></td></td>
                  <td><?= $dataAbsensiSakit['tanggal_permohonan'] ?></td></td>
                  <td>
                    <a href="dist/img/surat-sakit/<?= $dataAbsensiSakit['surat_sakit'] ?>" target="_blank" class="btn btn-info">Lihat Surat Sakit</a>
                    <button onclick="return confirmPopUp('warning', 'Hapus Permohonan Sakit', 'Apakah anda yakin ingin menghapus data permohonan sakit ini?', 'Yakin', 'Tidak', '?page=hapus_absensi_sakit&id=<?= $dataAbsensiSakit['id_absensi_sakit'] ?>', '?page=data_absensi_sakit');" class="btn btn-danger">Hapus</button>
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