<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
if (isset($_POST['status_permohonan'])) {
  $idAbsenPermohonanCuti = $_POST['id_absen_cuti'];
  $statusPermohonan = $_POST['status_permohonan'];

  $queryUpdateStatusPermohonan = querySQL("UPDATE absensi_cuti SET status_permohonan = '$statusPermohonan' WHERE id_absensi_cuti = '$idAbsenPermohonanCuti'");
  if ($queryUpdateStatusPermohonan) {
    echo "<script>alertPopUp('?page=data_absensi_cuti', 'success', 'Berhasil mengubah status permohonan cuti');</script>";
  } else {
    echo "<script>alertPopUp(null, 'error', 'Gagal mengubah status permohonan cuti');</script>";
  }
}
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Data Permohonan Cuti</h3>
    <div class="card card-outline card-info">
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table table-bordered text-nowrap">
            <thead>
              <th>No</th>
              <th>Status Permohonan</th>
              <th>Karyawan</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Selesai</th>
              <th>Keterangan</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $queryAbsensiCuti = querySQL("SELECT * FROM absensi_cuti LEFT JOIN users ON absensi_cuti.user_id = users.id_user");
                while ($dataAbsensiCuti = mysqli_fetch_assoc($queryAbsensiCuti)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td>
                    <form id="form_ubah_permohonan" method="post">
                      <input type="hidden" name="id_absen_cuti" value="<?= $dataAbsensiCuti['id_absensi_cuti'] ?>">
                      <select name="status_permohonan" id="status_permohonan" class="form-control" onchange="this.form.submit()">
                        <?php
                          $statusPermohonan = ['Menunggu', 'Diterima', 'Ditolak'];
                          foreach ($statusPermohonan as $status) {
                        ?>
                          <option value="<?= $status ?>" <?= ($dataAbsensiCuti['status_permohonan'] === $status) ? 'selected' : '' ?>><?= $status ?></option>
                        <?php } ?>
                      </select>
                    </form>
                  </td>
                  <td><?= $dataAbsensiCuti['nama_lengkap'] ?></td>
                  <td><?= $dataAbsensiCuti['tanggal_mulai'] ?></td>
                  <td><?= $dataAbsensiCuti['tanggal_selesai'] ?></td>
                  <td><?= $dataAbsensiCuti['keterangan'] ?></td>
                  <td><?= $dataAbsensiCuti['tanggal_permohonan'] ?></td>
                  <td>
                    <button onclick="return confirmPopUp('warning', 'Hapus Permohonan Cuti', 'Apakah anda yakin ingin menghapus data permohonan cuti ini?', 'Yakin', 'Tidak', '?page=hapus_absensi_cuti&id=<?= $dataAbsensiCuti['id_absensi_cuti'] ?>', '?page=data_absensi_cuti');" class="btn btn-danger">Hapus</button>
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