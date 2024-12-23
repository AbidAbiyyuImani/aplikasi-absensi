<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
if (isset($_POST['status_permohonan'])) {
  $idAbsenPermohonan = $_POST['id_absen_permohonan'];
  $statusPermohonan = $_POST['status_permohonan'];
  $queryUpdateStatusPermohonan = querySQL("UPDATE absensi_izin SET status_permohonan = '$statusPermohonan' WHERE id_absensi_izin = '$idAbsenPermohonan'");
  if ($queryUpdateStatusPermohonan) {
    echo "<script>alertPopUp(null, 'success', 'Berhasil mengubah status permohonan izin');</script>";
  } else {
    echo "<script>alertPopUp(null, 'error', 'Gagal mengubah status permohonan izin');</script>";
  }
}
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Data Permohonan Izin</h3>
    <div class="card card-outline card-info">
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table table-bordered text-nowrap">
            <thead>
              <th>No</th>
              <th>Karyawan</th>
              <th>Jam</th>
              <th>Keterangan</th>
              <th>Tanggal</th>
              <th>Status Permohonan</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $queryAbsensiIzin = querySQL("SELECT * FROM absensi_izin LEFT JOIN users ON absensi_izin.user_id = users.id_user");
                while ($dataAbsensiIzin = mysqli_fetch_assoc($queryAbsensiIzin)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataAbsensiIzin['nama_lengkap'] ?></td>
                  <td><?= $dataAbsensiIzin['jam_awal'] . " - " . $dataAbsensiIzin['jam_akhir'] ?></td>
                  <td><?= $dataAbsensiIzin['keterangan'] ?></td>
                  <td><?= $dataAbsensiIzin['tanggal_permohonan'] ?></td>
                  <td>
                    <form id="form_ubah_permohonan" method="post">
                      <input type="hidden" name="id_absen_permohonan" value="<?= $dataAbsensiIzin['id_absensi_izin'] ?>">
                      <select name="status_permohonan" id="status_permohonan" class="form-control" onchange="this.form.submit()">
                        <?php $statusPermohonan = ['Menunggu', 'Diterima', 'Ditolak'];
                        foreach ($statusPermohonan as $status) { ?>
                          <option value="<?= $status ?>" <?= ($dataAbsensiIzin['status_permohonan'] === $status) ? 'selected' : '' ?>><?= $status ?></option>
                        <?php } ?>
                      </select>
                    </form>
                  </td>
                  <td>
                    <button onclick="return confirmPopUp('warning', 'Hapus Permohonan Izin', 'Apakah anda yakin ingin menghapus data permohonan izin ini?', 'Yakin', 'Tidak', '?page=hapus_absensi_izin&id=<?= $dataAbsensiIzin['id_absensi_izin'] ?>', '?page=data_izin');" class="btn btn-danger">Hapus</button>
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