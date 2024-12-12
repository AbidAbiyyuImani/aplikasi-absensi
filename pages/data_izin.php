<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };
?>
<?php $namaHalaman = "Izin Sakit"; $linkHalaman = "Data Izin Sakit"; include 'components/breadcrumb.php';?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap table-data">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Permohonan</th>
                <th>Status Permohonan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $queryIzin = querySQL("SELECT * FROM absensi_sakit LEFT JOIN users ON absensi_sakit.user_id = users.id_user");
                while ($dataIzin = mysqli_fetch_assoc($queryIzin)) {
              ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?= $dataIzin['nama_lengkap'] ?></td>
                <td><?= $dataIzin['tanggal_permohonan'] ?></td>
                <td><?= $dataIzin['status_permohonan'] ?></td>
                <td>
                  <?php $level = $_SESSION['pengguna']['level'];
                  switch ($level) {
                    case "Admin":
                  ?>
                    <a href="?page=ubah_izin&id=<?= $dataIzin['id_sakit'] ?>" class="btn btn-warning">Ubah</a>
                  <?php break; case "Super Admin": ?>
                    <a href="?page=ubah_izin&id=<?= $dataIzin['id_sakit'] ?>" class="btn btn-warning">Ubah</a>
                    <a href="?page=hapus_izin&id=<?= $dataIzin['id_sakit'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data izin sakit ini?');" class="btn btn-danger">Hapus</a>
                  <?php break; }  ?>
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