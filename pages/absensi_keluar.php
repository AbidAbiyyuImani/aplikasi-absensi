<?php include 'config/functions.php';
$userId = $_SESSION['pengguna']['id_user']; $now = date('Y-m-d');
$queryAbsensiNow = querySQL("SELECT jam_masuk, jam_keluar, tanggal_absensi FROM absensi WHERE user_id = '$userId' AND tanggal_absensi = '$now'");
$dataAbsensi = mysqli_fetch_assoc($queryAbsensiNow);

if ($_SESSION['pengguna']['jk_id'] !== null) {
  if ($dataAbsensi == null) {
    echo "<script>alertPopUp('?page=absensi_masuk', 'error', 'Anda belum melakukan absen masuk', 'Mengalihkan ke halaman absen masuk...');</script>";
  }
} else {
  echo "<script>alertPopUp('index.php', 'error', 'Jam Kerja belum di tentukan', 'Mengalihkan ke halaman utama...');</script>";
}
?>
<script src="dist/js/webcam.js"></script>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Absen Keluar</h3>
    <div class="card">
      <div class="card-body my-3">
        <div id="my_camera"></div>
        <div id="results" class="d-none">
          <img id="imageprev" src="" class="img-fluid">
        </div>
        <!-- hidden form -->
        <form id="form_absensi_keluar" method="post" enctype="multipart/form-data" class="mb-3">
          <input type="hidden" name="foto" id="foto">
        </form>
        <?php if (isset($dataAbsensi)) { ?>
          <div class="alert alert-info <?= ($dataAbsensi['jam_keluar'] !== null) ? 'd-block' : 'd-none' ?>">Hari ini sudah dilakukan absen, <a href="?page=histori">lihat histori absen</a></div>
        <?php } ?>
        <div class="alert alert-warning <?= ($_SESSION['pengguna']['jk_id'] !== null) ? 'd-none' : '' ?>">Jam Kerja belum di tentukan</div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <button type="button" onclick="retake()" class="retake btn btn-warning d-none">Ambil Ulang</button>
        <?php if (isset($dataAbsensi)) { ?>
          <button type="button" onclick="snapshot()" <?= ($dataAbsensi['jam_keluar'] !== null) ? 'disabled' : '' ?> class="take btn btn-primary">Ambil Foto</button>
          <?php } else { ?>
            <button type="button" onclick="snapshot()" disabled class="take btn btn-primary">Ambil Foto</button>
        <?php } ?>
        <button type="submit" name="absen_keluar" form="form_absensi_keluar" class="absen btn btn-primary d-none">Absen Keluar</button>
      </div>
    </div>
  </div>
</div>
<script>
  Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach('#my_camera');
  function snapshot() {
    Webcam.snap(function(data_uri) {
      $('#my_camera').addClass('d-none');
      $('#results').removeClass('d-none');
      $('#imageprev').attr('src', data_uri);
      $('#foto').val(data_uri);
      $('.take').addClass('d-none');
      $('.retake').removeClass('d-none');
      $('.absen').removeClass('d-none');
    })
  }
  function retake() {
    $('#my_camera').removeClass('d-none');
    $('#results').addClass('d-none');
    $('#imageprev').attr('src', '');
    $('#foto').val('');
    $('.take').removeClass('d-none');
    $('.retake').addClass('d-none');
    $('.absen').addClass('d-none');
  }
</script>

<?php
if (isset($_POST['absen_keluar'])) {
  try {
    $userId = $_SESSION['pengguna']['id_user'];
    $jamKeluar = date('H:i:s');
    $tanggal = date('Y-m-d');

    $foto = $_POST['foto'];
    $foto = str_replace('data:image/jpeg;base64,', '', $foto);
    $foto = str_replace(' ', '+', $foto);
    $foto = base64_decode($foto);
    $filename = 'absen_keluar_'.date('Ymd_His').'.jpg';
    file_put_contents('dist/img/absensi/'.$filename, $foto);

    $queryAbsensi = querySQL("UPDATE absensi SET jam_keluar = '$jamKeluar', foto_keluar = '$filename' WHERE user_id = '$userId' AND tanggal_absensi = '$tanggal'");
    if($queryAbsensi) {
      echo "<script>alertPopUp('index.php', 'success', 'Berhasil melakukan absen keluar', 'Mengalihkan ke halaman utama...');</script>";
    } else {
      echo "<script>alertPopUp(null, 'error', 'Gagal melakukan absen keluar');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alertPopUp(null, 'warning', 'Tidak dapat melakukan absen keluar');</script>";
  }
}
?>