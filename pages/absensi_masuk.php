<?php include 'config/functions.php';
$userId = $_SESSION['pengguna']['id_user']; $now = date('Y-m-d');
// CEK APAKAH JAM KERJA SUDAH DI TENTUKAN
if ($_SESSION['pengguna']['jk_id'] == null) {
  echo "<script>alertPopUp('index.php', 'error', 'Jam Kerja belum di tentukan', 'Mengalihkan ke halaman utama...');</script>";
} else {
  // CEK APAKAH SUDAH ABSEN ATAU BELUM
  $queryAbsensiNow = querySQL("SELECT jam_masuk, tanggal_absensi FROM absensi WHERE user_id = '$userId' AND tanggal_absensi = '$now'");
  $dataAbsensi = mysqli_fetch_assoc($queryAbsensiNow);
  if ($dataAbsensi !== null) {
    echo "<script>alertPopUp('?page=absensi_keluar', 'error', 'Anda sudah melakukan absen masuk', 'Mengalihkan ke halaman absen keluar...');</script>";
  }
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Absen Masuk</h3>
    <div class="card">
      <div class="card-body my-3">
        <div id="kamera"></div>
        <div id="hasil" class="d-none">
          <img id="gambar" src="" class="img-fluid">
        </div>
        <!-- hidden form -->
        <form id="form_absensi_masuk" method="post" enctype="multipart/form-data" class="mb-3">
          <input type="hidden" name="foto" id="foto">
        </form>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <button type="button" onclick="retake()" class="retake btn btn-warning d-none">Ambil Ulang</button>
        <button type="button" onclick="snapshot()" <?= ($_SESSION['pengguna']['jk_id'] !== null) ? '' : 'disabled' ?> class="take btn btn-primary">Ambil Foto</button>
        <button type="submit" name="absen_masuk" form="form_absensi_masuk" class="absen btn btn-primary d-none">Absen Masuk</button>
      </div>
    </div>
  </div>
</div>
<script src="dist/js/webcam.js"></script>
<script>
  Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach('#kamera');
  function snapshot() {
    Webcam.snap(function(data_uri) {
      $('#kamera').addClass('d-none');
      $('#hasil').removeClass('d-none');
      $('#gambar').attr('src', data_uri);
      $('#foto').val(data_uri);
      $('.take').addClass('d-none');
      $('.retake').removeClass('d-none');
      $('.absen').removeClass('d-none');
    })
  }
  function retake() {
    $('#kamera').removeClass('d-none');
    $('#hasil').addClass('d-none');
    $('#gambar').attr('src', '');
    $('#foto').val('');
    $('.take').removeClass('d-none');
    $('.retake').addClass('d-none');
    $('.absen').addClass('d-none');
  }
</script>
<?php
  if (isset($_POST['absen_masuk'])) {
    try {
      $userId = $_SESSION['pengguna']['id_user'];
      $jamMasuk = date('H:i:s');
      $tanggal = date('Y-m-d');

      $foto = $_POST['foto'];
      $foto = str_replace('data:image/jpeg;base64,', '', $foto);
      $foto = str_replace(' ', '+', $foto);
      $foto = base64_decode($foto);
      $filename = 'absen_masuk_' . date('Ymd_His') . '.jpg';
      file_put_contents('dist/img/absensi/' . $filename, $foto);

      $queryAbsensi = querySQL("INSERT INTO absensi (user_id, jam_masuk, foto_masuk, tanggal_absensi) VALUES ('$userId', '$jamMasuk', '$filename', '$tanggal')");
      if ($queryAbsensi) {
        echo "<script>alertPopUp('index.php', 'success', 'Berhasil melakukan absen masuk', 'Mengalihkan ke halaman utama...');</script>";
      } else {
        echo "<script>alertPopUp(null, 'error', 'Gagal melakukan absen masuk');</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp(null, 'warning', 'Tidak dapat melakukan absen masuk');</script>";
    }
  }
}
?>