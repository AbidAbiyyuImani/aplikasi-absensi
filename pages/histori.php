<?php include 'config/functions.php'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-2">Histori Absensi</h3>
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap table-data">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1; $idUser = $_SESSION['pengguna']['id_user'];
              $queryAbsensi = querySQL("SELECT * FROM absensi LEFT JOIN users ON absensi.user_id = users.id_user WHERE user_id = '$idUser'");
              if (mysqli_num_rows($queryAbsensi) > 0) {
                while ($dataAbsensi = mysqli_fetch_assoc($queryAbsensi)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= dateToFullDate($dataAbsensi['tanggal_absensi']) ?></td>
                  <td><?= $dataAbsensi['jam_masuk'] ?></td>
                  <td><?= ($dataAbsensi['jam_keluar']) ? $dataAbsensi['jam_keluar'] : '-' ?></td>
                </tr>
              <?php } } ?>
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