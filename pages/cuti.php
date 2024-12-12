<?php include 'config/functions.php'; ?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <h3 class="mb-3">Cuti</h3>
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap table-data">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Keterangan</th>
                <th>Tanggal Permohonan</th>
                <th>Status</th>
                <th>Detail</th>
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
                    <a href="?page=detail_cuti&id=<?= $dataCuti['id_cuti'] ?>" class="btn btn-info">Detail</a>
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