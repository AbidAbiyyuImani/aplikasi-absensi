<?php include 'config/functions.php'; ?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Histori Absensi</h3>
    <div class="card card-outline card-info">
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table table-bordered text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Detail</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $idUser = $_SESSION['pengguna']['id_user'];
                $queryAbsensi = querySQL("SELECT * FROM absensi LEFT JOIN users ON absensi.user_id = users.id_user WHERE user_id = '$idUser'");
                while ($dataAbsensi = mysqli_fetch_assoc($queryAbsensi)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataAbsensi['tanggal_absensi'] ?></td>
                  <td><?= $dataAbsensi['jam_masuk'] ?></td>
                  <td><?= ($dataAbsensi['jam_keluar']) ? $dataAbsensi['jam_keluar'] : '-' ?></td>
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