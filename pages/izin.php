<?php include 'config/functions.php'; ?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <h3 class="mb-3">Izin Sakit</h3>
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap table-data">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Permohonan</th>
                <th>Status Permohonan</th>
                <th>Detail</th>
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
                    <a href="?page=detail_izin&id=<?= $dataIzin['id_sakit'] ?>" class="btn btn-info">Detail</a>
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