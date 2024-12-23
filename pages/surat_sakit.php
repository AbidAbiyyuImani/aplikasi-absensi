<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
if (isset($_GET['id'])) {
  $idAbsenSakit = $_GET['id'];
  $queryAbsensiSakit = querySQL("SELECT * FROM absensi_sakit LEFT JOIN users ON absensi_sakit.user_id = users.id_user WHERE id_absensi_sakit = '$idAbsenSakit'");
  $dataAbsensiSakit = mysqli_fetch_assoc($queryAbsensiSakit);
}
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Surat Sakit</h3>
    <div class="card card-outline card-info">
      <div class="card-body">
        <img src="dist/img/surat-sakit/<?= $dataAbsensiSakit['surat_sakit'] ?>" alt="<?= $dataAbsensiSakit['nama_lengkap'] ?>" width="355px">
      </div>
      <div class="card-footer">
        <a href="?page=data_absensi_sakit" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
  </div>
</div>

<?php } ?>