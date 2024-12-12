<?php include 'config/functions.php';

if(isset($_POST['absen_cuti'])) {
  // try {
    $userId = $_SESSION['pengguna']['id_user'];
    $tanggal = date('Y-m-d');
    $keterangan = $_POST['keterangan'];
    $statusCuti = "Menunggu Persetujuan";

    $queryAbsensi = querySQL("INSERT INTO absensi_cuti (user_id, keterangan, tanggal_permohonan, status_cuti) VALUES ('$userId', '$keterangan', '$tanggal', '$statusCuti')");
    if($queryAbsensi) {
      echo "<script>alert('Absen Cuti Berhasil');location.href='index.php';</script>";
    } else {
      echo "<script>alert('Absen Cuti Gagal');</script>";
    }
  // } catch (Exception $e) {
  //   echo "<script>alert('Absen Cuti Gagal');</script>";
  // }
}
?>

<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Absen Cuti</h3>
    <div class="card">
      <div class="card-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="keterangan">Keterangan Cuti</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Keterangan Cuti" required></textarea>
          </div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <button type="submit" name="absen_cuti" class="btn btn-primary float-right">Absen Cuti</button>
      </form>
      </div>
    </div>
  </div>
</div>