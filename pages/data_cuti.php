<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };
?>
<?php $namaHalaman = "Cuti"; $linkHalaman = "Data Cuti"; include 'components/breadcrumb.php';?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap table-data">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Keterangan</th>
                <th>Tanggal Permohonan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $queryCuti = querySQL("SELECT * FROM absensi_cuti LEFT JOIN users ON absensi_cuti.user_id = users.id_user");
                while ($dataCuti = mysqli_fetch_assoc($queryCuti)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataCuti['nama_lengkap'] ?></td>
                  <td><?= $dataCuti['keterangan'] ?></td>
                  <td><?= $dataCuti['tanggal_permohonan'] ?></td>
                  <td><?= $dataCuti['status_permohonan'] ?></td>
                  <td>
                    <?php $level = $_SESSION['pengguna']['level'];
                    switch ($level) {
                      case "Admin":
                    ?>
                      <a href="?page=ubah_cuti&id=<?= $dataCuti['id_cuti'] ?>" class="btn btn-warning">Ubah</a>
                    <?php break; case "Super Admin": ?>
                      <a href="?page=ubah_cuti&id=<?= $dataCuti['id_cuti'] ?>" class="btn btn-warning">Ubah</a>
                      <a href="?page=hapus_cuti&id=<?= $dataCuti['id_cuti'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data permohonan cuti ini?');" class="btn btn-danger">Hapus</a>
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