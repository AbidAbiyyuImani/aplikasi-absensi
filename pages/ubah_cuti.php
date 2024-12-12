<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idCuti = $_GET['id'];
$queryCuti = querySQL("SELECT * FROM absensi_cuti WHERE id_cuti = $idCuti");
$dataCuti = mysqli_fetch_assoc($queryCuti);

if(isset($_POST['ubah_cuti'])) {
  try {
    $statusPermohonan = $_POST['statusPermohonan'];
  
    $queryUpdate = querySQL("UPDATE absensi_cuti SET status_permohonan = '$statusPermohonan' WHERE id_cuti = $idCuti");
    if($queryUpdate) {
      echo "<script>alert('Ubah Data Permohonan Cuti Berhasil');location.href='?page=data_cuti';</script>";
    } else {
      echo "<script>alert('Ubah Data Permohonan Cuti Gagal');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Ubah Data Permohonan Cuti Gagal');</script>";
  }
}
?>

<div class="row">
  <div class="col-12">
    <div class="card card-outline card-warning">
      <div class="card-body">
        <h3 class="mb-3">Absen Cuti</h3>
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="keterangan">Keterangan Cuti</label>
            <textarea name="keterangan" id="keterangan" rows="3" placeholder="Keterangan Cuti" required readonly class="form-control"><?= $dataCuti['keterangan'] ?></textarea>
          </div>
          <div class="form-group">
            <select name="statusPermohonan" id="statusPermohonan" class="form-control">
              <?php $statusPermohonan = ['Menunggu Persetujuan', 'Disetujui', 'Ditolak'];
              foreach($statusPermohonan as $status) {
              ?>
                <option value="<?= $status ?>" <?= $dataCuti['status_permohonan'] === $status ? 'selected' : '' ?>><?= $status ?></option>
              <?php } ?>
            </select>
          </div>
      </div>
      <div class="card-footer">
        <a href="?page=data_cuti" class="btn btn-secondary">Kembali</a>
        <button type="submit" name="ubah_cuti" class="btn btn-warning float-right">Ubah Status</button>
      </form>
      </div>
    </div>
  </div>
</div>