<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idIzin = $_GET['id'];
$queryIzin = querySQL("SELECT * FROM absensi_sakit WHERE id_sakit = $idIzin");
$dataIzin = mysqli_fetch_assoc($queryIzin);

if(isset($_POST['ubah_izin'])) {
  try {
    $statusPermohonan = $_POST['statusPermohonan'];
  
    $queryUpdate = querySQL("UPDATE absensi_sakit SET status_permohonan = '$statusPermohonan' WHERE id_sakit = $idIzin");
    if($queryUpdate) {
      echo "<script>alert('Ubah Data Permohonan Izin Sakit Berhasil');location.href='?page=data_izin';</script>";
    } else {
      echo "<script>alert('Ubah Data Permohonan Izin Sakit Gagal');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Ubah Data Permohonan Izin Sakit Gagal');</script>";
  }
}
?>

<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Izin Sakit</h3>
    <div class="card">
      <div class="card-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <select name="statusPermohonan" id="statusPermohonan" class="form-control">
              <?php $statusPermohonan = ['Menunggu Persetujuan', 'Disetujui', 'Ditolak'];
              foreach($statusPermohonan as $status) {
              ?>
                <option value="<?= $status ?>" <?= $dataIzin['status_permohonan'] === $status ? 'selected' : '' ?>><?= $status ?></option>
              <?php } ?>
            </select>
          </div>
      </div>
      <div class="card-footer">
        <a href="?page=data_cuti" class="btn btn-secondary">Kembali</a>
        <button type="submit" name="ubah_izin" class="btn btn-warning float-right">Ubah Data Cuti</button>
      </form>
      </div>
    </div>
  </div>
</div>