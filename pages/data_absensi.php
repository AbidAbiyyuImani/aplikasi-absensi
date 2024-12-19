<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };
?>
<?php $namaHalaman = "Absensi"; $linkHalaman = "Data Absensi"; include 'components/breadcrumb.php';?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table table-bordered text-nowrap table-data">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Detail</th>
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