<?php include 'config/functions.php';
$idDetail = $_GET['id'];
$queryDetail = querySQL("SELECT * FROM absensi LEFT JOIN users ON absensi.user_id = users.id_user WHERE id_absensi = '$idDetail'");
$dataDetail = mysqli_fetch_assoc($queryDetail);
var_dump($dataDetail);
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-2">Detail Absensi</h3>
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap">
            <tr>
              <th>Nama</th>
              <td><?= $dataDetail['nama_lengkap'] ?></td>
            </tr>
            <tr>
              <th>Tanggal Absen</th>
              <td><?= $dataDetail['tanggal_absensi'] ?></td>
            </tr>
            <tr>
              <th>Jam Masuk</th>
              <td><?= $dataDetail['jam_masuk'] ?></td>
            </tr>
            <tr>
              <th>Jam Keluar</th>
              <td><?= $dataDetail['jam_keluar'] ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="index.php?page=absensi" class="btn btn-primary">Kembali</a>
      </div>
    </div>
  </div>
</div>