<?php include 'config/functions.php';
$idCuti = $_GET['id'];
$queryCuti = querySQL("SELECT * FROM absensi_cuti LEFT JOIN users ON absensi_cuti.user_id = users.id_user WHERE id_cuti = '$idCuti'");
$dataCuti = mysqli_fetch_assoc($queryCuti);
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-3">Detail Cuti</h3>
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap">
            <tr>
              <th>Nama</th>
              <td><?= $dataCuti['nama_lengkap'] ?></td>
            </tr>
            <tr>
              <th>Tanggal Permohonan</th>
              <td><?= $dataCuti['tanggal_permohonan'] ?></td>
            </tr>
            <tr>
              <th>Status Permohonan</th>
              <td><?= $dataCuti['status_permohonan'] ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
  </div>
</div>