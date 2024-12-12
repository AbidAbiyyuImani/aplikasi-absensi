<?php include 'config/functions.php';
$idIzin = $_GET['id'];
$queryIzin = querySQL("SELECT * FROM absensi_sakit LEFT JOIN users ON absensi_sakit.user_id = users.id_user WHERE id_sakit = '$idIzin'");
$dataIzin = mysqli_fetch_assoc($queryIzin);
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-3">Detail Izin</h3>
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap">
            <tr>
              <th>Nama</th>
              <td><?= $dataIzin['nama_lengkap'] ?></td>
            </tr>
            <tr>
              <th>Tanggal Permohonan</th>
              <td><?= $dataIzin['tanggal_permohonan'] ?></td>
            </tr>
            <tr>
              <th>Surat Izin</th>
              <td><img src="dist/img/surat/<?= $dataIzin['surat_sakit'] ?>" alt="Surat Izin" width="300px" class="img-fluid"></td>
            </tr>
            <tr>
              <th>Status Permohonan</th>
              <td><?= $dataIzin['status_permohonan'] ?></td>
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